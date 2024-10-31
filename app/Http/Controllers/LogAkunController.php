<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ProfileUsers;
use App\Models\Timeline;
use File;
use Alert;
use App\Models\ProfileUser;

class LogAkunController extends Controller
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

    //profil
    public function dataprofil(){
        return view ('profil');
    }

    //
    public function editprofil(Request $a){
            $message = [
                'nama.required' => 'Nama tidak boleh kosong',
                'email.required' => 'Email tidak boleh kosong',
            ];

            $cekValidasi = $a->validate([
                'nama' => 'required',
                'email' => 'required',
            ], $message);



            $file = $a->file('foto');
            if(file_exists($file)){
                $nama_file = time() . "-" . $file->getClientOriginalName();
                $namaFolder = 'foto profil';
                $file->move($namaFolder,$nama_file);
                $pathFoto = $namaFolder."/".$nama_file;
            } else {
                $pathFoto = $a->pathFoto;
            }

            ProfileUser::where("user_id", Auth::user()->id)->update([
                'nama' => $a->nama,
                'email' => $a->email,
                'foto' => $pathFoto,
                'tempat_lahir' => $a->tempat,
                'tanggal_lahir' => $a->tanggal,
                'gender' => $a->jk,
                'no_hp' => $a->hp,
                'alamat' => $a->alamat,
                'instagram' => $a->ig
            ]);
            User::where("id", Auth::user()->id)->update([
                'name' => $a->nama
            ]);
            Timeline::create([
                'user_id' => Auth::user()->id,
                'status' => 'Memperbaharui Profile Akun',
                'pesan' => Auth::user()->id.'Memperbaharui Profile Akunnya',
                'tgl_update' => now(),
                'created_at' => now()
            ]);
            return redirect('/profile')->with('success', 'Profil Akun Terubah!');
            

    }

    public function editakun(Request $a){
        $dataUser = ProfileUser::all();
        $message = [
            'password.required' => 'Password tidak boleh kosong',
            'passwordbaru.required' => 'Password baru tidak boleh kosong',
            'passwordbaru2.required' => 'Ulangi password baru harus sama dan tidak boleh kosong',
        ];

        $cekValidasi = $a->validate([
            'password' => 'required',
            'passwordbaru' => 'required|min:6|max:255',
            'passwordbaru2' => 'required|min:6|max:255'
        ], $message);

        if (Hash::check($a->password,  Auth::user()->password)) {
            $id = Auth::user()->id;
            User::where("id", $id)->update([
                'password' => bcrypt($a->passwordbaru),
            ]);

        }
        Timeline::create([
            'user_id' => Auth::user()->id,
            'status' => 'Memperbaharui Kata Sandi',
            'pesan' => Auth::user()->id.'Memperbaharui Kata Sandi Akunnya',
            'tgl_update' => now(),
            'created_at' => now()
        ]);
        return redirect('/profile')->with('success', 'Kata Sandi Akun Terubah!');
    }
}
