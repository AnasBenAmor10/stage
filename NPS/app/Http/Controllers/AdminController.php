
<?php

namespace App\Http\Controllers;

use App\Models\Stage;
// use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use SebastianBergmann\Type\NullType;

class AdminController extends Controller
{
    // view function
    public function home()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }
        $usertype = Auth::user()->usertype;
        if ($usertype != '0') {
            return redirect('/');
        }
        return redirect('redirects');
    }
    public function etudiant_menu()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }
        $usertype = Auth::user()->usertype;
        if ($usertype != '0') {
            return redirect('/');
        }
        $total_etudiant = DB::table('users')->where('role', '0')->count();
        $user = DB::table('users')->where('role', '0')->get();;
        return view('admin.etudiants', compact('total_etudiant', 'users'));
    }
    public function stage_menu()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }
        $usertype = Auth::user()->usertype;
        if ($usertype != '0') {
            return redirect('/');
        }
        $total_stage = DB::table('stages')->count();
        $stages = Stage::all();
        return view('admin.stage', compact('total_stage', 'stage'));
    }
    public function enseignant_menu()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }
        $usertype = Auth::user()->usertype;
        if ($usertype != '0') {
            return redirect('/');
        }
        $total_enseignant = DB::table('users')->where('role', '1')->count();
        $enseignants = DB::table('users')->where('role', '1')->get();
        return view('admin.enseignants', compact('total_enseignant', 'enseignants'));
    }
    public function encadrant_menu()
    {
        if (!Auth::user()) {
            return redirect()->route('login');
        }
        $usertype = Auth::user()->usertype;
        if ($usertype != '0') {
            return redirect('/');
        }
        $encadrants = DB::table('supervisors')->get();
        $nombreStagesParEncadrant = [];
        foreach ($encadrants as $encadrant) {
            $nombreStages = DB::table('supervisors')->where('encadrant_id', $encadrant->id)->count();
            $nombreStagesParEncadrant[$encadrant->id] = $nombreStages;
        }
        return view('admin.encadrants', compact('encadrants', 'nombreStageParEncadrant'));
    }
    //add function
    public function add_stage()
    {
        return view('admin.add_stage');
    }
    public function add_etudiant()
    {
        return view('admin.add_etudiant');
    }
    public function add_enseigant()
    {
        return view('admin.add_enseigant');
    }
    public function add_encadrant()
    {
        return view(('admin.add_encadrant'));
    }
    public function add_admin()
    {
        return view('admin.add_admin');
    }
    public function add_admin_process(Request $request)
    {
        $email = DB::table('users')->where('email', $request->email)->count();

        if ($email > 0) {
            session()->flash('wrong', 'Email already registred !');
            return back();
        }
        $phone = DB::table('users')->where('phone', $request->phone)->count();


        if ($phone > 0) {

            session()->flash('wrong', 'Phone already registered !');
            return back();
        }
        if (strlen($request->password) < 8) {
            session()->flash('wrong', 'Password length at least 8 words ! ');
        }
        if ($request->password != $request->confirm_password) {
            session()->flash('wrong', 'Password do not match !');
        }
        $this->validate(request(), [

            'image' => 'mimes:jpeg,jpg,png',
        ]);
        $uploadedfile = $request->file('image');
        $new_image = rand() . '.' . $uploadedfile->getClientOriginalExtension();
        $uploadedfile->move(public_path('/assets/images/admin/'), $new_image);

        $data = array();
        $data['full_name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['usertype'] = $request->type;
        $data['profile_photo_path'] = $new_image;
        $data['password'] = Hash::make($request->password);
        if ($request->type == '1') {
            $usertype = "Super Admin";
        } else if ($request->type == '3') {
            $usertype = 'Sub Admin';
        }
        $insert = DB::table('users')->insert($data);
        $details = [
            'title' => 'Mail from  Admin',
            'body' => 'congrats ! you are selected as a ' . $usertype .
                ' by Admin Panel.Your Email ID - ' . $request->email . ' & Password - ' . $request->password,
        ];
        MaiL::to($request->email)->send(new \App\Mail\UserAddedMail($details));
        session()->flash('success', 'Admin added successfully !');
        return back();
    }
    public function delete_admin($id)
    {
        $my_id = Null;
        if (Auth::user()->id == $id) {
            $my_id = 'yes';
        }
        $details = [
            'title' => 'Mail from  NPS Admin',
            'body' => 'Sorry ! You have been fired from your job by Admin Panel.So, your account is deleted by NPS Admin Panel.',
        ];



        Mail::to(Auth::user()->email)->send(new \App\Mail\UserAddedMail($details));

        $delete = DB::table('users')->where('id', $id)->delete();


        if ($my_id == "yes") {

            return redirect()->route('login');
        }

        session()->flash('success', 'Admin deleted successfully !');
        return back();
    }
    public function edit_admin($id)
    {
        $admin = DB::table('users')->where('id', $id)->get();
        return view('admin.edit_admin', compact('admin'));
    }
    public function edit_admin_process(Request $request, $id)
    {
        $previous_position = DB::table('users')->where('id', $id)->value('usertype');
        $email = DB::table('users')->where('email', $request->email)->where('id', '!=', $id)->count();
        if ($email > 0) {
            session()->flash('wrong', 'Email already registered !');
            return back();
        }
        $phone = DB::table('users')->where('phone', $request->phone)->where('id', '!=', $id)->count();


        if ($phone > 0) {

            session()->flash('wrong', 'Phone already registered !');
            return back();
        }
        $data = array();
        $data['full_name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['usertype'] = $request->type;
        if ($request->image != NULL) {

            $this->validate(request(), [

                'image' => 'mimes:jpeg,jpg,png',
            ]);


            $uploadedfile = $request->file('image');
            $new_image = rand() . '.' . $uploadedfile->getClientOriginalExtension();
            $uploadedfile->move(public_path('/assets/images/admin/'), $new_image);
            $data['profile_photo_path'] = $new_image;
        }
        if ($request->type == '1') {


            $usertype = "Super Admin";
        } else if ($request->type == '3') {


            $usertype = "Sub Admin";
        }



        $update = DB::table('users')->where('id', $id)->Update($data);

        if ($update) {
            $details = [
                'title' => 'Mail from Admin',
                'body' => 'Congrats ! Your information is updated by NPS Admin Panel.',
            ];


            if (($request->type != NULL && $request->type < $previous_position)) {


                $details = [
                    'title' => 'Mail from Admin',
                    'body' => 'Congrats ! You are promoted for a ' . $usertype . ' position. of NPS by NPS Admin Panel.',
                ];
            } else if (($request->type != NULL && $request->type > $previous_position)) {


                $details = [
                    'title' => 'Mail from RMS Admin',
                    'body' => 'Sorry ! You are depromoted for a ' . $usertype . ' position.  of NPS by NPS Admin Panel.',
                ];
            }


            Mail::to($request->email)->send(new \App\Mail\UserAddedMail($details));


            session()->flash('success', 'Admin updated successfully !');
        } else {

            session()->flash('wrong', 'Already same info exits !');
        }


        return back();
    }
}
