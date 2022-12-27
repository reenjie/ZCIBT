<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
       
        $firstname = $request->firstname;
        $middlename=$request->middlename;
        $lastname = $request->lastname;
        $birthdate = $request->birthdate;
        $contactno = $request->contactno;
        $address   = $request->address;
        $email     = $request->email;
        $password  = $request->password;
        $password_confirmation = $request->password_confirmation;


        $this->validate($request, [
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
            ]);


        User::create([
        'firstname'=>$firstname,
        'middlename'=>$middlename,
        'lastname'=>$lastname,
        'birthdate'=>$birthdate,
        'user_type'=>3,
        'license_no'=>null,
        'bus_id'=>0,
        'address'=>$address,
        'contact_no'=>$contactno,
        'fl'=>0,
        'vrfy'=>0,
        'status'=>0,
        'email'=>$email,
        'password'=>Hash::make($password),
        ]);

        return redirect()->route('login')->with('success','Registered Successfully. Please Login');
        //Hash::make($data[$password])

        // $this->validator($request->all())->validate();

        // event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);

        // if ($response = $this->registered($request, $user)) {
        //     return $response;
        // }

        // return $request->wantsJson()
        //             ? new JsonResponse([], 201)
        //             : redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }
}
