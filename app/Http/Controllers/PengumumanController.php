<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProfileUser;
use App\Models\Jurusan;
use App\Models\Sekolah;
use App\Models\Pengumuman;
use App\Models\Pendaftaran;
use App\Models\Timeline;
use Illuminate\Support\Facades\Session;

class PengumumanController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(function($request,$next){
            if (session('success')) {
                Session::success(session('success'));
            }

            if (session('error')) {
                Session::error(session('error'));
            }

            return $next($request);
        });
    }

    //data pengumuman kompliit
    public function datapengumuman()
    {
        $dataUser = ProfileUser::all();
        $data = Pengumuman::all();
        $dataid = Pendaftaran::all();
        $dataprod = Jurusan::all();
        return view ('pengumuman.data-pengumuman-admin',['viewDataUser' => $dataUser,'viewData' => $data,'viewIdPendaftaran' => $dataid,'viewjurusan' => $dataprod]);
    }

    public function lihatpengumuman(Request $a)
    {
        $dataUser = ProfileUser::all();
        $dataditemukan = Pengumuman::where("id_pendaftaran", $a->id_pendaftaran)->first();
        $data = Pengumuman::all();
        $dataid = Pendaftaran::where("id_pendaftaran", $a->id_pendaftaran)->first();
        $dataskl = Sekolah::all();
        return view ('pengumuman.data-pengumuman-view',['viewDataUser' => $dataUser,'viewData' => $data,'viewIdPendaftaran' => $dataid,'viewID' => $dataditemukan,'viewSekolah' => $dataskl]);
    }


    public function simpanpengumuman(Request $a)
    {
        try{
        //$dataUser = ProfileUser::all();
            $kode = Pengumuman::id();
            Pengumuman::create([
                'id_pengumuman' => $kode,
                'id_pendaftaran' => $a->id_pendaftaran,
                'hasil_seleksi' => $a->hasil,
                'jurusan_penerima' => $a->penerima,
                'nilai_interview' => $a->interview,
                'nilai_test' => $a->test
            ]);
            Timeline::create([
                'user_id' => Auth::user()->id,
                'status' => "Pengumuman",    
                'pesan' => 'Membuat Pengumuman',
                'tgl_update' => now(),
                'created_at' => now()
            ]);
            return redirect('/data-announcement')->with('success', 'Data Tersimpan!!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Disimpan!');
        }
    }

    public function updatepengumuman(Request $a, $id_pengumuman){
        //$dataUser = ProfileUser::all();
        try{
            $jurusan =  preg_replace("/[^0-9]/", "", $a->jurusan);
            if($jurusan == 0)
            {
                $jurusan = null;
            }
            Pengumuman::where("id_pengumuman", $id_pengumuman)->update([
                'id_pendaftaran' => $a->id_pendaftaran,
                'hasil_seleksi' => $a->hasil,
                'jurusan_penerima' => $jurusan,
                'nilai_interview' => $a->interview,
                'nilai_test' => $a->test,
            ]);
            if($a->hasil =="LULUS" || $a->hasil =="TIDAK LULUS"){
                Pendaftaran::where("id_pendaftaran", "$a->id_pendaftaran")->update([
                    "status_pendaftaran"=>"Selesai"
                ]);
            }
            Timeline::create([
                'user_id' => Auth::user()->id,
                'status' => "Pengumuman",    
                'pesan' => 'Memperbaharui Pengumuman',
                'tgl_update' => now(),
                'created_at' => now()
            ]);
            return redirect('/data-announcement')->with('success', 'Data Terubah!!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Diubah!');
        }
    }
    

    public function hapuspengumuman($id_pengumuman){
        //$dataUser = ProfileUser::all();
        try{
            $data = Pengumuman::find($id_pengumuman);
            $data->delete();
            return redirect('/data-announcement')->with('success', 'Data Terhapus!!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Dihapus!');
        }
    }
}
