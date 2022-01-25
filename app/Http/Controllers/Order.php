<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class Order extends Controller
{
    public function Order(Request $request){
        DB::table('tbl_keranjang')->insert([
            'id_user' => Session::get('id_user'),
            'id_barang' => $request->id_barang,
            'jumlah' => $request->jumlah
        ]);
        return redirect('/');
    }

    public function Keranjang(){
        $keranjang = DB::table('keranjang')->where('id_user',Session::get('id_user'))->get();
        return view('keranjang',['keranjang'=>$keranjang]);
    }

    public function Checkout(){
        $id_check = rand();
        $total = 0;
        
        $data = DB::table('tbl_keranjang')->where('id_user',Session::get('id_user'))->get();

        foreach ($data as $krj) {
            $barang = DB::table('tbl_barang')->where('id',$krj->id_barang)->get();
            foreach ($barang as $brg) {
                $total += ($krj->jumlah * $brg->harga);
                DB::table('detail_checkout')->insert([
                    'id_checkout' => $id_check,
                    'id_barang' => $krj->id_barang,
                    'jumlah' => $krj->jumlah
                ]);
                    // echo $id_check."<br>" ;
                    // echo $krj->id_barang."<br>";
                    // echo $krj->jumlah."<br>";
            };
        };
        
        db::table('tbl_checkout')->insert([
            'id_checkout' => $id_check,
            'id_user' => Session::get('id_user'),
            'total' => $total
        ]);
        return redirect('/Checkout_List');

        // echo $id_check."<br>";
        // echo Session::get('id_user')."<br>";
        // echo$total."<br>";
    }

    public function Checkout_List(){
        $checkout = DB::table('checkout')->where('id_user',Session::get('id_user'))->get();
        return view('Checkout',['checkout'=>$checkout]);
    }
}