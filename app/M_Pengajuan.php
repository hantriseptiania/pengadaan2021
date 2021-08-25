<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M_Pengajuan extends Model
{
    //
      protected $table = 'tbl_pengajuan';
    protected $primaryKey = 'id_pengajuan';
      protected $fillable = ['id_pengajuan','id_supplier', 'id_pengadaan','anggaran','proposal', 'status'];
}
