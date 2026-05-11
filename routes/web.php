<?php

use Illuminate\Support\Facades\Route;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Expr\FuncCall;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/vee', function () {

    $daftarTugas = Tugas::all();
    return view('daftar-tugas', compact('daftarTugas'));
});

Route::post('/vee', function (Request $request) {
    $validasi = $request->validate(
        ['deskripsi' => 'required', 'string']
    );

    Tugas::create(['deskripsi' => $validasi['deskripsi']]);

    return Redirect('/vee');
});

Route::put('/vee/{id}', function (Request $request, $id) {
    $validasi = $request->validate(
        ['deskripsi' => 'required', 'string']
    );

    $tugas = Tugas::findOrFail($id);
    $tugas->update(['deskripsi' => $validasi['deskripsi']]);

    return Redirect('/vee');
});

Route::delete('/vee/{id}', function ($id) {
    $tugas = Tugas::findOrFail($id);
    $tugas->delete();

    return Redirect('/vee');
});