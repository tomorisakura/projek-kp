<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pelanggan;
use Illuminate\Support\Facades\Validator;
Use Alert;

class PelangganController extends Controller
{

    public function index() {
        $pelanggan = Pelanggan::all();
        return view('admin.pelanggan', compact('pelanggan'));
    }

    public function register(Request $request) {

        $pelanggan = array(
          'nama_pemilik' => $request['nama_pemilik'],
          'alamat' => $request['alamat'],
          'no_hp' => $request['no_hp'],
          'email' => $request['email']
        );

        Validator::make($request->all(), [
            'nama_pemilik' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'email', 'max:255'],
            'no_hp' => ['required', 'string', 'max:10'],
            'email' => ['required', 'string', 'max:255'],
        ]);
    
        Pelanggan::create($pelanggan);
        $pelanggan = Pelanggan::all();
    
        return redirect('/adm/pemilik-hewan')->withSuccessMessage('Berhasil Ditambahkan');
    }

    public function getData(Request$request ,$id) {
        $data = Pelanggan::find($id);
        echo json_encode($data);
    }

    public function update(Request $request) {
        $data = Pelanggan::find($request->get('id'));

        $data->nama_pemilik = $request->get('nama_pemilik');
        $data->alamat = $request->get('alamat');
        $data->no_hp = $request->get('no_hp');
        $data->email = $request->get('email');
        $data->save();
        echo "sukses";
        return view('admin.pelanggan');
    }

    public function delete(Request $request, $id) {
        $data = Pelanggan::find($id);
        $data->delete($id);
    }
}
