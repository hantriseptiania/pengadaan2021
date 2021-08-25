<?php

Route::get('/','Home@index');
//route registrasi
Route::get('/registrasi','Registrasi@index');
//route simpan data registrasi
Route::post('/regis','Registrasi@regis');

//route halaman login sup
Route::get('/login','Supplier@login');
Route::post('/masukSupplier','Supplier@masukSupplier');

Route::get('/supplierKeluar','Supplier@supplierKeluar');

Route::get('/masukAdmin','Admin@index');

Route::post('/loginAdmin','Admin@loginAdmin');

Route::get('/pengajuan','Pengajuan@pengajuan');

Route::get('/keluarAdmin','Admin@keluarAdmin');

Route::get('/listAdmin','Admin@listAdmin');

Route::post('/tambahAdmin','Admin@tambahAdmin');

Route::post('/ubahAdmin','Admin@ubahAdmin');

Route::get('/hapusAdmin/{id}', 'Admin@hapusAdmin');

Route::get('/listPengadaan','Pengadaan@index');

Route::post('/tambahPengadaan','Pengadaan@tambahPengadaan');

Route::get('/hapusGambar/{id}', 'Pengadaan@hapusGambar');

Route::post('/uploadGambar','Pengadaan@uploadGambar');

Route::get('/hapusPengadaan/{id}', 'Pengadaan@hapusPengadaan');

Route::post('/ubahPengadaan','Pengadaan@ubahPengadaan');


Route::get('/listSupplier', 'Pengadaan@listSupplier');

Route::post('/tambahPengajuan','Pengajuan@tambahPengajuan');

Route::get('/terimaPengajuan/{id}', 'Pengajuan@terimaPengajuan');

Route::get('/tolakPengajuan/{id}', 'Pengajuan@tolakPengajuan');

Route::get('/riwayatku', 'Pengajuan@riwayatku');

Route::post('/tambahLaporan','Pengajuan@tambahLaporan');

Route::get('/laporan', 'Pengajuan@laporan');

Route::get('/selesaiPengajuan/{id}', 'Pengajuan@selesaiPengajuan');

Route::get('/pengajuanselesai', 'Pengajuan@pengajuanselesai');

Route::get('/tolakLaporan', 'Pengajuan@tolakLaporan');

Route::get('/listSup','Supplier@listSup');

Route::get('/nonAktif/{id}','Supplier@nonAktif');

Route::get('/Aktif/{id}','Supplier@Aktif');

Route::post('/ubahPasswordSup','Supplier@ubahPassword');

Route::post('/ubahPasswordAdm','Admin@ubahPassword');