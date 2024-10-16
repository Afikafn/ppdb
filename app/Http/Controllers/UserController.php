<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\ProfileUser;
use App\Models\Timeline;
use File;
use Alert;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(function($request, $next) {
            if (session('success')) {
                Session::flash('success', session('success'));
            }

            if (session('error')) {
                Session::flash('error', session('error'));
            }

            if (session('warning')) {
                Session::flash('warning', session('warning'));
            }
            return $next($request);
        });
    }

    
    //data user
    public function datauser(){
        $dataUser = User::all();
        $kode = ProfileUser::id();
        return view ('user.data-user-admin',compact('dataUser','kode'));
    }
    

    public function simpanuser(Request $a)
    {
        try {

            $password = Hash::make($a->input('password'));

            $checkuser = User::where('email', $a->email)->first();
            if ($checkuser) {
                return redirect()->back()->with('warning', 'Email Telah Terdaftar!');
            }

            $user = User::create([
                'name' => $a->input('name'),
                'email' => $a->input('email'),
                'password' => $password,
                'role' => $a->input('level'),
                'created_at' => now()
            ]);

            $usersid = $user->id;

            if ($a->hasFile('foto')) {
                $file = $a->file('foto');
                $nama_file = time() . "-" . $file->getClientOriginalName();
                $namaFolder = 'foto profil';
                $file->move(public_path($namaFolder), $nama_file);
                $pathFoto = $namaFolder . "/" . $nama_file;

                ProfileUser  ::create([
                    'user_id' => $usersid,
                    'nama' => $a->nama,
                    'email' => $a->email,
                    'tanggal_lahir' => "2000-01-01",
                    'gender' => $a->gender,
                    'no_hp' => $a->nohp,
                    'foto' => $pathFoto
                ]);
            } else {
                ProfileUser  ::create([
                    'user_id' => $usersid,
                    'nama' => $a->nama,
                    'email' => $a->email,
                    'tanggal_lahir' => "2000-01-01",
                    'gender' => $a->gender,
                    'no_hp' => $a->nohp,
                ]);
            }

            Timeline::create([
                'user_id' => $usersid,
                'status' => "Bergabung",
                'pesan' => 'Membuat Akun baru',
                'tgl_update' => now(),
                'created_at' => now()
            ]);

            return redirect('/data-registration')->with('success', 'Data Tersimpan!!');
            } catch (\Exception $e){
                echo $e->getMessage();
                //return redirect()->back()->with('error', 'Data Tidak Berhasil Tersimpan!');
            }
    }


    public function edituser($user_id)
    {
        $dataUser = ProfileUser::all();
        $dataUserbyId = ProfileUser::find($user_id);
        return view('user.data-user-detail',['viewDataUser' => $dataUser,'viewData'=>$dataUserbyId]);
    }


    
    public function updateuser(Request $request, string $id)
{
    $profileuser = ProfileUser::find($id);
    $profileuser->update([
        'tempat_lahir' => $request->tempat,
        'tanggal_lahir' => $request->tanggal,
        'gender' => $request->jk,
        'no_hp' => $request->hp,
        'alamat' => $request->alamat,
        'instagram' => $request->ig,
    ]);

    return redirect('/data-user')->with("success",'Data Berhasil Diupdate');
}

    public function hapususer($user_id){
        //$dataUser = ProfileUser::all();
    try{
        $dataProfileUser = ProfileUser::find($user_id);
        $id=$dataProfileUser['Email'];
        $dataUser = User::find($user_id);
        $dataProfileUser->delete();
        $dataUser->delete();
        return redirect('/data-user')->with("success",'Data Berhasil Dihapus');
    }catch (\Exception $e){
        return redirect()->back()->with('error', 'Data Tidak Berhasil Dihapus!');
    }
    }

    
    public function insertRegis(Request $a){
        try{
            $checkuser = User::where('email',$a->email)->first();
            if($checkuser){
                return redirect()->back()->with('warning', 'Email Telah Terdaftar!');
            }
            User::create([
                'name' => $a->name,
                'email' => $a->email,
                'password' => Hash::make($a->password),
                'role' => $a->level,
                'created_at' => now()
            ]);
            $usersid  = User::orderBy('id', 'DESC')->first();
            ProfileUser::create([
                'user_id' => $usersid->id,
                'nama' => $a->name,
                'email' => $a->email,
                'created_at' => now()
            ]);
            Timeline::create([
                'user_id' => $usersid->id,
                'status' => "Bergabung",
                'pesan' => 'Membuat Akun baru',
                'tgl_update' => now(),
                'created_at' => now()
            ]);
        return redirect('/')->with('success', 'Berhasil Register!');
    }catch (\Exception $e){
        return redirect()->back()->with('error', 'Data Tidak Tersimpan!');
    }
    }
}
