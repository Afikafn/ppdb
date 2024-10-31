<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pengumuman extends Model
{
    use HasFactory;
    protected $table = "pengumuman";
    protected $fillable = ["id_pengumuman","user_id","id_pendaftaran","hasil_seleksi","jurusan_penerima","status"];
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey= "id";

    public static function id()
    {
        $data = Pengumuman::orderby('id_pendaftaran','DESC')->first();
        
        if ($data) {
            $kodeakhir5 = substr($data->id_pendaftaran,-3);
            $kodeku = (int)$kodeakhir5 + 1;
        } else {
            $kodeku = 1;
        }
        
        $addNol = '';
        $kodetb = 'TAG';
        
        // Generate the code
        $kode = (int)$kodeku;
        $incrementKode = $kode;

        // Add leading zeros to the code
        if (strlen($kode) == 1) {
            $addNol = "000";
        } elseif (strlen($kode) == 2) {
            $addNol = "00";
        } elseif (strlen($kode) == 3) {
            $addNol = "0";
        } elseif (strlen($kode) == 4) {
            $addNol = "";
        }
        $kodeBaru = 'ANN'.now()->format('y').$addNol.$incrementKode;

        return $kodeBaru;
    }

	public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'id_pendaftaran');
 	}
     public function jurusan()
     {
         return $this->belongsTo(Jurusan::class, 'jurusan_penerima');
      }

    public function user()
    {
         return $this->belongsTo(User::class, 'user_id');
    }

    public function pilihan1() {
        return $this->belongsTo(Jurusan::class, 'pil1'); // Assuming 'pil1' is the foreign key
    }
    
    public function pilihan2() {
        return $this->belongsTo(Jurusan::class, 'pil2'); // Assuming 'pil2' is the foreign key
    }
}

