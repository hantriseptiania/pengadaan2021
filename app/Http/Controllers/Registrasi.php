<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import lib validasi
use Illuminate\Support\Facades\Validator;

//import fungsi encrypt
use Illuminate\Contracts\Encryption\DecryptException;

//import lib session
use Illuminate\Support\Facades\Session;

//import model supplier
use App\M_supplier;

class Registrasi extends Controller
{
    //
    public function index(){
        $token = Session::get('token');

        $tokenDb = M_supplier::where('token', $token)->count();

        if($tokenDb > 0){
            $data['token'] = $token;

        }else{
            $data['token'] = "kosong";
        }
        return view('registrasi.registrasi',$data);
       
    }
    public function regis(Request $request){

        $this->validate($request,
            [
                'nama_usaha' => 'required',
                'email'=> 'required',
                'alamat'=>'required',
                'npwp'=>'required',
                'password'=>'required'
            ]
        );

        if(M_supplier::create(
            [
                'nama_usaha'=>$request->nama_usaha,
                'email'=>$request->email,
                'alamat'=>$request->alamat,
                'no_npwp'=>$request->npwp,
                'password'=>encrypt($request->password)
            ]
        )){
            return redirect('/registrasi')->with('berhasil','Data berhasil disimpan');
        }else{
            return redirect('/registrasi')->with('gagal','Data gagal disimpan');
        }
    }
}
