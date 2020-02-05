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

        // $datas = $req['email'];

        $url = "https://api.telegram.org/bot1097638403:AAEhd7JX7BX3admcSyzoKTmVBOhLDDTghiM/getUpdates";
        
        $objek = file_get_contents($url);
        $datas = json_decode($objek, true);
        $nama = 0;

        // dd($datas['result'][1]['message']['chat']);

        for ($i=0; $i < 10; $i++) { 
            if($datas['result'][1]['message']['chat']['username'] == 'xxkyoko') {
                $nama = 1;
            } else {
                $nama = 6;
            }
        }

        dd($nama);
        //data berhasil men :v

        // dd(response()->json($datas));

        return view('admin.pelanggan', compact('pelanggan'));
    }

    public function register(Request $request) {

        $datas = new Pelanggan;
        
        // $pelanggan = array(
        //   'nama_pemilik' => $request['nama_pemilik'],
        //   'alamat' => $request['alamat'],
        //   'no_hp' => $request['no_hp'],
        //   'telegram' => $request['email']
        // );

        Validator::make($request->all(), [
            'nama_pemilik' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'email', 'max:255'],
            'no_hp' => ['required', 'string', 'max:10'],
        ]);

        $datas->nama_pemilik = $request->nama_pemilik;
        $datas->alamat = $request->alamat;
        $datas->no_hp = $request->no_hp;
        if($request->email == "") {
            $datas->telegram = "Tidak Ada";
        } else {
            $datas->telegram = $request->email;
        }
        $datas->id_chat = 0;
        $datas->save();

        Alert::success('Registrasi Berhasil', 'Data Pemilik Berhasil Ditambahkan');
    
        return redirect('/adm/pemilik-hewan')->withSuccessMessage('Berhasil Ditambahkan');
    }

    // public function getChat(Request $req) {
    //     $pelanggan = Pelanggan::all();
    //     $datas = $req['email'];

    //     $url = "https://api.telegram.org/bot1097638403:AAEhd7JX7BX3admcSyzoKTmVBOhLDDTghiM/getUpdates";
        
    //     $objek = json_decode($url);

    //     for ($i=0; $i <= $pelanggan ; $i++) { 
            
    //     }
    // }

    public function getData(Request$request ,$id) {
        $data = Pelanggan::find($id);
        echo json_encode($data);
    }

    public function update(Request $request) {
        $id = $request->id;
        $data = Pelanggan::find($id);
        $data->nama_pemilik = $request->get('nama_pemilik');
        $data->alamat = $request->get('alamat');
        $data->no_hp = $request->get('no_hp');
        $data->telegram = $request->get('email');
        // dd($data);
        $data->save();
        echo "sukses";

        Alert::success('Update Berhasil', 'Data Berhasil Diubah');

        return redirect('/adm/pemilik-hewan')->withSuccessMessage('Berhasil Update');
    }

    public function delete(Request $request, $id) {
        $data = Pelanggan::find($id);
        $data->delete($id);
    }
}
