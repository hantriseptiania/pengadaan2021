<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import lib session
use Illuminate\Support\Facades\Session;

//import model supplier
use App\M_supplier;

//import model pengadaan
use App\M_Pengadaan;

class Home extends Controller
{
    //function index
    public function index(){
        $key = env('APP_KEY');
        //echo "fungsi index home";
        $token = Session::get('token');
        $tokenDb = M_supplier::where('token', $token)->count();
        if($tokenDb > 0){
            $data['token'] = $token;
        }else{
            $data['token'] = "kosong";
        }

        $data['pengadaan'] = M_Pengadaan::where('status','1')->paginate(15);
        return view('utama.home', $data);
    }
}
