<?php

namespace App\Http\Controllers;

use App\claim;
use App\client;
use App\log_claim;
use App\transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function show($id)
    {
        $client = client::find($id);

        return view('transaksi.show', compact('client'));
    }

    public function simpanTrx(Request $request)
    {
        $cl = client::find($request->id);
        $jum = $request->jum;
        $cek = transaksi::where('client_id', $cl->id)->count();
        if ($cek > 0) {
            for ($x = 1; $x <= $jum; $x++) {
                $trx = transaksi::where('client_id', $cl->id)->orderBy('jumlah', 'DESC')->first();
                $sim = transaksi::create([
                    "client_id" => $cl->id,
                    "jumlah" => $trx->jumlah + 1
                ]);
            }
        } else {
            for ($x = 1; $x <= $jum; $x++) {
                $sim = transaksi::create([
                    "client_id" => $cl->id,
                    "jumlah" => $x
                ]);
            }
        }
    }

    public function claim($id)
    {
        $transaksi = transaksi::where('client_id', $id)->orderBy('jumlah', 'ASC')->take(10)->get();


        for($x = 1; $x <= 10; $x++){

            $trx = transaksi::where([
                "client_id" => $id,
                "jumlah" => $x
            ])->first();

            $sim_log = log_claim::create([
                "client_id" => $trx->client_id,
                "jumlah" => $trx->jumlah,
                "bonus" => $trx->bonus,
            ]);

            $trx->delete();
        }
        // cek dulu di tabel claim
        $cek_claim = claim::where('client_id', $id)->first();
        if(!$cek_claim){
            $sim_claim = claim::create([
                "client_id" => $id,
                "claim" => 1
            ]);
        }else{
            $add = claim::where('client_id', $id)->orderBy('claim', 'DESC')->first();
            $sim_claim = claim::create([
                "client_id" => $id,
                "claim" => $add->claim + 1
            ]);
        }

        // jika ada jumlah yang lebih dari 10 maka di reset lagi ke 1
        $cek = transaksi::where("client_id", $id)->where('jumlah', '>=', 10)->first();
        if($cek)
        {
            for($x = 1; $x <= 10; $x++){
                $update = transaksi::where("client_id", $id)->where('jumlah', '>=', 10)->orderBy('jumlah')->first();
                if($update){
                    $update->jumlah = $x;
                    $update->update();
                }

            }
        }
    }
}
