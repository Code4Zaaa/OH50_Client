<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Client;
use App\Models\Log as LogModel;
use Illuminate\Http\Request;
class ClientController extends Controller
{

    function login(Request $request){
        $request->validate([
            "nama"=>"required",
            "instansi"=>"required"
        ]);

        $namaArray = array_filter($request->nama, function($value) {
            return !is_null($value) && $value !== ''; 
        });
    
        if (empty($namaArray)) {
            return back()->withErrors(['nama' => 'At least one name must be provided.']);
        }
    
        foreach ($namaArray as $nama) {
            Client::create([
                'nama' => $nama,
                'instansi' => $request->instansi,
            ]);
    
            LogModel::create([
                'ip' => $request->ip(),
                'tag' => 'ADD',
                'message' => "Data $nama with {$request->instansi} Created",
            ]);
        }
    
        return back()->with("success", "Data Berhasil Disimpan");
    }

    function logging(){
        $Kamis = Client::whereDate('created_at', '=', '2025-05-08')->count();
        $Jumat = Client::whereDate('created_at', '=', '2025-05-09')->count();
        $Sabtu = Client::whereDate('created_at', '=', '2025-04-010')->count();
        $Total = Client::count();
        return view('logging', compact('Kamis','Jumat', 'Sabtu', 'Total'));
    }

    function aksi(Request $request){
        session(['nama' => $request->input('name')]);
        session(['pass' => $request->input('pass')]);
        return redirect(url('logging'));
    }
}
