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
        $this->middleware(function($request,$next){
            if (session('success')) {
                Session::success(session('success'));
            }

            if (session('error')) {
                Session::error(session('error'));
            }
            
            if (session('warning')) {
                Session::warning(session('warning'));
            }
            return $next($request);
        });
    }


    //data prodi kompliit
    public function dataprodi(){
        $viewData = Jurusan::all();
        return view ('jurusan.data-jurusan-admin',compact('viewData'));
    }

    public function simpanprodi(Request $a)
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

    public function updateprodi(Request $a, $id_prodi){
        //$dataUser = Pengguna::all();
        try{
            $fileft = $a->file('foto');
            if(file_exists($fileft)){
                $nama_fileft = "Prodi".time() . "-" . $fileft->getClientOriginalName();
                $namaFolderft = 'foto prodi';
                $fileft->move($namaFolderft,$nama_fileft);
                $path = $namaFolderft."/".$nama_fileft;
            } else {
                $path = $a->pathnya;
            }
            Jurusan::where("id", $id_prodi)->update([
                'nama_prodi' => $a->nama,
                'jenjang_prodi' => $a->jenjang,
                'foto_prodi' => $path,
        ]);
            return redirect('/data-prodi')->with('success', 'Data Terubah!!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Diubah!');
        }
    }

    public function hapusprodi($id_prodi){
        //$dataUser = Pengguna::all();
        try{
            $data = Jurusan::find($id_prodi);
            $data->delete();
            return redirect('/data-prodi')->with('success', 'Data Terhapus!!');
        } catch (\Exception $e){
            return redirect()->back()->with('error', 'Data Tidak Berhasil Dihapus!');
        }
    }
}
