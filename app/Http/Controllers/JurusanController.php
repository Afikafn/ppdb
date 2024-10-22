<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Session;

class JurusanController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(function($request, $next) {
            if ($request->session()->has('success')) {
                $request->session()->flash('success', $request->session()->get('success'));
            }

            if ($request->session()->has('error')) {
                $request->session()->flash('error', $request->session()->get('error'));
            }

            if ($request->session()->has('warning')) {
                $request->session()->flash('warning', $request->session()->get('warning'));
            }
            return $next($request);
        });
    }


    //data jurusan kompliit
    public function datajurusan(){
        $viewData = Jurusan::all();
        return view ('jurusan.data-jurusan-admin',compact('viewData'));
    }

    public function simpanjurusan(Request $a)
    {
        try{

            $kode=Jurusan::id();

            $fileft = $a->file('foto');
            if(file_exists($fileft)){
                $nama_fileft = "jurusan".time() . "-" . $fileft->getClientOriginalName();
                $namaFolderft = 'foto jurusan';
                $fileft->move($namaFolderft,$nama_fileft);
                $path = $namaFolderft."/".$nama_fileft;
            } else {
                $path = null;
            }
            
            Jurusan::create([
                'id_jurusan' => $kode,
                'nama_jurusan' => $a->nama,
                'foto_jurusan' => $path,
        ]);
            return redirect('/data-jurusan')->with('success', 'Data Tersimpan!!');
        } catch (\Exception $e){
            echo $e;
            //return redirect()->back()->with('error', 'Data Tidak Berhasil Disimpan!');
        }
    }

    public function updatejurusan(Request $a, $id_jurusan){
        //$dataUser = Pengguna::all();
        try{
            $fileft = $a->file('foto');
            if(file_exists($fileft)){
                $nama_fileft = "jurusan".time() . "-" . $fileft->getClientOriginalName();
                $namaFolderft = 'foto jurusan';
                $fileft->move($namaFolderft,$nama_fileft);
                $path = $namaFolderft."/".$nama_fileft;
            } else {
                $path = $a->pathnya;
            }
            Jurusan::where("id", $id_jurusan)->update([
                'nama_jurusan' => $a->nama,
                'foto_jurusan' => $path,
        ]);
            return redirect('/data-jurusan')->with('success', 'Data Terubah!!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Diubah!');
        }
    }

    public function hapusjurusan($id_jurusan){
        //$dataUser = Pengguna::all();
        try{
            $data = Jurusan::find($id_jurusan);
            $data->delete();
            return redirect('/data-jurusan')->with('success', 'Data Terhapus!!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Dihapus!');
        }
    }
}
