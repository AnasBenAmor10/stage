<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EtudiantController extends Controller
{
    //
    public function view_Encadrant()
    {
        $encadrant = DB::table('supervisors')->where('nombre', '!=', '0')->get();
        return view('Etudiant.view_encadrant', compact('encadrant'));
    }
    public function view_stage($id)
    {
        $stage = Stage::find($id);
        return view('Etudiant.view_stage')->with('stage', $stage);;
    }
    // public function view_resultat($id)
    // {
    //     $user=User::find($id);
    //     if($user){

    //     }
    // }
}
