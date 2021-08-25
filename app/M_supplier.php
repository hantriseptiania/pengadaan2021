<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class M_supplier extends Model
{
    //
    protected $table = 'tbl_supplier';
    protected $primaryKey = 'id_supplier';
    protected $fillable = ['id_supplier','nama_usaha', 'email','alamat','no_npwp', 'password', 'status', 'token'];
}
