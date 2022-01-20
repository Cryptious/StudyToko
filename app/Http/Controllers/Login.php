<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class Login extends Controller
{
    public function index(){
        return view('Login');
    }

    public function Register(Request $request){
        DB::table('tbl_user')->insert([
            'nama_user' => $request->nama,
            'email' => $request->email,
            'password' => $request->password
        ]);
        return redirect('/Login');
    }
}
