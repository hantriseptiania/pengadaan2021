<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

//import lib session
use Illuminate\Support\Facades\Session;

//import lib JWT
use \Firebase\JWT\JWT;

//import lib response
use Illuminate\Http\Response;

//import lib validator
use Illuminate\Support\Facades\Validator;

//import lib Enkripsi
use Illuminate\Contracts\Encryption\DecryptExeption;


//Memanggil Model M_Supplier
use App\M_Supplier;

//impor model admin
use App\M_Admin;

class Supplier extends Controller
{
    //fungsi u menampilkan halaman login
    public function login(){
      return view('supplier.login');
    }

    public function masukSupplier(Request $request){
     $this->validate($request,
            [
                'email' => 'required',
                'password' => 'required'
            ]

        );

        $cek = M_Supplier::where('email',$request->email)->count();
        $sup = M_Supplier::where('email',$request->email)->get();

        if($cek > 0){
            foreach($sup as $s){
                if(decrypt($s->password) == $request->password){
                    $key = env('APP_KEY');
                    $data = array(
                        "id_supplier" => $s->id_supplier
                    );

                    $jwt = JWT::encode($data,$key);

                    M_Supplier::where('id_supplier',$s->id_supplier )->update(
                        [
                            'token' => $jwt
                        ]);

                    Session::put('token',$jwt);
                    return redirect('/listSupplier');

                }else{
                    return redirect('/login')->with('gagal','Password Anda Salah');
                }
            }

        }else{
            return redirect('/login')->with('gagal','Data email tidak terdaftar');
        }

    }

    public function supplierKeluar(){

      $token = Session::get('token');
      if(M_Supplier::where('token',$token)->update(

        [
          'token' => 'keluar',
        ]
      )){
        session::put('token',"");
        return redirect('/');
      }else{
        return redirect('/masukSupplier')->with('gagal','Anda gagal Logout, silahkan Login terlebihdahulu');
      }
    }

     public function listSup(){
      $token = Session::get('token');
      $tokenDb = M_Admin::where('token', $token)->count();

      if($tokenDb > 0){
        $data['adm'] = M_Admin::where('token', $token)->first();
     $data['supplier'] = M_Supplier::paginate(15);
     return view('admin.listSup',$data);

      }else{

        return redirect('/masukAdmin')->with('gagal','Anda sudah Logout, Silakan Login Kembali');

      }
    }
    public function nonAktif($id){
        $token = Session::get('token');
      $tokenDb = M_Admin::where('token', $token)->count();

      if($tokenDb > 0){
        if(M_Supplier::where('id_supplier', $id)->update(["status" => "0"])){
            return redirect('/listSup')->with('Berhasil','Data Berhasil Diupdate');
        }else{
            return redirect('/listSup')->with('Gagal','Data Gagal Diupdate');

        }

      }else{

        return redirect('/masukAdmin')->with('gagal','Anda sudah Logout, Silakan Login Kembali');

      }
    }

    public function Aktif($id){
        $token = Session::get('token');
      $tokenDb = M_Admin::where('token', $token)->count();

      if($tokenDb > 0){
        if(M_Supplier::where('id_supplier', $id)->update(["status" => "1"])){
            return redirect('/listSup')->with('Berhasil','Data Berhasil Diupdate');
        }else{
            return redirect('/listSup')->with('Gagal','Data Gagal Diupdate');

        }

      }else{

        return redirect('/masukAdmin')->with('gagal','Anda sudah Logout, Silakan Login Kembali');

      }
    }

    public function ubahPassword(Request $request){
        $token = Session::get('token');
        $tokenDb = M_Supplier::where('token', $token)->count();

        if($tokenDb > 0){
            $key = env('APP_KEY');

            $sup = M_Supplier::where('token', $token)->first();

        $decode = JWT::decode($token, $key, array('HS256'));
        $decode_array = (array) $decode;

        if(decrypt($sup->password) == $request->passwordLama){
            if(M_Supplier::where('id_supplier', $decode_array['id_supplier'])->update(["password" => encrypt($request->password)])){
            return redirect('/masukSupplier')->with('gagal','Password Berhasil Diupdate');
        }else{
            return redirect('/listSupplier')->with('Gagal','Password Gagal Diupdate');

        }

        }else{
           return redirect('/listSupplier')->with('gagal','Password Gagal Diupdate, Password Lama Tidak Sama'); 
        }

        

      }else{

        return redirect('/masukSupplier')->with('gagal','Anda sudah Logout, Silakan Login Kembali');

      }

    }
}
