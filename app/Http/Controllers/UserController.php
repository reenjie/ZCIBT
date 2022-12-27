<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        return view('users.index', ['users' => $model->paginate(15)]);
    }

    public function createnewuser(Request $request){
        $usertype = $request->user_type;
        $firstname = $request->firstname;
        $middlename=$request->middlename;
        $lastname = $request->lastname;
        $birthdate = $request->birthdate;
        $contactno = $request->contactno;
        $address   = $request->address;
        $email     = $request->email;
        $password  = $request->password;
        $password_confirmation = $request->password_confirmation;
        if($request->bus_id){
            $bus_id = $request->bus_id;
        }else{
            $bus_id = 0;
        }

        $this->validate($request, [
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
            ]);


        User::create([
        'firstname'=>$firstname,
        'middlename'=>$middlename,
        'lastname'=>$lastname,
        'birthdate'=>$birthdate,
        'user_type'=>$usertype,
        'license_no'=>null,
        'bus_id'=>$bus_id,
        'address'=>$address,
        'contact_no'=>$contactno,
        'fl'=>0,
        'vrfy'=>1,
        'status'=>0,
        'email'=>$email,
        'password'=>Hash::make($password),
        ]);

        return redirect()->route('page.index', 'users')->with('success','Account Added Successfully!');
    }
}
