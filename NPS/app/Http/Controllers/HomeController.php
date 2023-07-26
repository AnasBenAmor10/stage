<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function register(Request $req)
    {
        $data = array();
        $data['full_name'] = $req->full_name;
        $data['email'] = $req->email;
        $data['phone'] = $req->phone;
        $data['password'] = Hash::make($req->password);
        $email = DB::table('users')->where('email', $req->email)->count();


        if ($email > 0) {

            session()->flash('wrong', 'Email already registered !');
            return back();
        }
        $phone = DB::table('users')->where('phone', $req->phone)->count();


        if ($phone > 0) {

            session()->flash('wrong', 'Phone already registered !');
            return back();
        }
        if (strlen($req->password) < 8) {

            session()->flash('wrong', 'Password lenght at least 8 words!');
            return back();
        }

        if ($req->password != $req->password_confirmation) {


            session()->flash('wrong', 'Password do not match !');
            return back();
        }

        $insert = DB::table('users')->Insert($data);


        return redirect('/redirects');
    }
    public function index()
    {
        $total_etudiant = DB::table('users')->where('role', '0')->count();
        $total_enseigant = DB::table('users')->where('role', '1')->count();
        return view("home", compact('total_etudiant', 'total_enseignant'));
    }
}
