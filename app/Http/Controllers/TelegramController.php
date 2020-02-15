<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Laravel\Facades\Telegram;
use App\Pelanggan;
Use Alert;

class TelegramController extends Controller
{
    public function updateActivity(Request $req, $id) {
        $username = "";
        $token = "1097638403:AAEhd7JX7BX3admcSyzoKTmVBOhLDDTghiM";
        $url = "https://api.telegram.org/bot". $token. "/getUpdates";

        $objek = file_get_contents($url);
        $datas = json_decode($objek, true);
        $id_tele = 0;
        // dd($datas['result'][1]['message']['chat']);
        $pelangganx = Pelanggan::find($id);
        $username = $pelangganx->telegram;
        for ($i=0; $i < 1000; $i++) { 
            if($datas['result'][$i]['message']['chat']['username'] == $username) {
                $id_tele = $datas['result'][$i]['message']['chat']['id'];
                $pelangganx->id_chat = json_encode($id_tele);
                $pelangganx->save();
            } else {
                echo "Data Tidak Ditemukan";
            }
        }
        
        //data berhasil men :v
        // dd(response()->json($datas));
        echo json_encode($datas);
    }

    public function sendMessage(Request $req, $id) {
        $token = "1097638403:AAEhd7JX7BX3admcSyzoKTmVBOhLDDTghiM";
        $id_chat_tele = 0;
        $nama = "";
        $pelanggan = Pelanggan::find($id);
        
        $id_chat_tele = $pelanggan->id_chat;
        $nama = $pelanggan->nama_pemilik;
        $message = "Aww.... ".$nama. "  Batas Waktu Penitipan Kamu Telah Selesai 🥺 , Segera Datang Ke Klinik Aywa Petcare ya ! ❤️";

        $param = [
            'chat_id' => $id_chat_tele,
            'text' => $message
        ];
        
        $url = "https://api.telegram.org/bot" . $token . "/sendMessage?" . http_build_query($param);
        file_get_contents($url);
    }

    public function sendMessageMedis(Request $req, $id) {
        $token = "1097638403:AAEhd7JX7BX3admcSyzoKTmVBOhLDDTghiM";
        $id_chat_tele = 0;
        $nama = "";
        $pelanggan = Pelanggan::find($id);
        
        $id_chat_tele = $pelanggan->id_chat;
        $nama = $pelanggan->nama_pemilik;
        $message = "Hay ".$nama. " Terima Kasih Telah Melakukan Medical Checkup di Klinik Aywa , Selamat Beraktivitas 🤩";

        $param = [
            'chat_id' => $id_chat_tele,
            'text' => $message
        ];
        
        $url = "https://api.telegram.org/bot" . $token . "/sendMessage?" . http_build_query($param);
        file_get_contents($url);
    }
}
