<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Jurusan;
use App\Models\Sekolah;
use App\Models\Pendaftaran;
use App\Models\Pengumuman;
use App\Models\Timeline;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware(function($request,$next){
            if (session('success')) {
                Session::flash('success', session('success'));
            }

            if (session('error')) {
                Session::flash('error', session('error'));
            }

            return $next($request);
        });
    }
    

    public function dashboard(){
        $dataPendaftar = Pendaftaran::selectRaw('count(*) as jmlpendaftar, tahun_masuk')
            ->groupBy('tahun_masuk')
            ->get();
        $data = Pendaftaran::select('status_pendaftaran', DB::raw('count(*) as jumlah'))
            ->groupBy('status_pendaftaran')
            ->get();
        $pendaftar = Pendaftaran::all();
        $jmlpendaftar = Pendaftaran::count();
        $dataUser  = User::all();
        $timeline = Timeline::all()->sortByDesc('created_at'); // or any other column you want to sort by
        $jmluser = User::count();
        $jmlpendaftarperjurusan = Pendaftaran::select('pil1', DB::raw('count(*) as jmldaftarprodi'))
            ->groupBy('pil1')
            ->get();
        $jmlpengumuman = Pengumuman::select('hasil_seleksi', DB::raw('count(*) as jumlah'))
            ->groupBy('hasil_seleksi')
            ->get();
        $jurusan = Jurusan::limit(4)->get();
        return view('dashboard', [
            'timeline' => $timeline,
            'viewDataUser ' => $dataUser ,
            'viewTotal' => $data,
            'viewTahunini' => $dataPendaftar,
            'pendaftar' => $pendaftar,
            'jmlpengumuman' => $jmlpengumuman,
            'jmlpendaftar' => $jmlpendaftar,
            'jmlpendaftarjurusan' => $jmlpendaftarperjurusan,
            'jmluser' => $jmluser,
            'jurusan' => $jurusan,
        ]);
    }
}
