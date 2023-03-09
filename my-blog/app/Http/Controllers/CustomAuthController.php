<?php

namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CustomAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:20'
        ]);
        
        $user = new User;
        $user->fill($request->all());
        $user->password = Hash::make($request->password);
        $user->save();

        $to_name  = $request->name;
        $to_email = $request->email;
        $body = "<a href='http://www.google.com'>Click here to confirm your account</a>";

        Mail::send('email.mail', ['name' => $to_name, 'body' => $body],
        function($message) use ($to_name, $to_email){
            $message->to($to_email, $to_name)->subject('Laravel Email Test');
        }
    );

        return redirect()->back()->withSuccess('User recorded !');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function show(user $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(user $user)
    {
        //
    }
    public function authentication(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6|max:20'
        ]);

        $credentials = $request->only('email', 'password');

        if(!Auth::validate($credentials)):
            return redirect()
                    ->back()
                    ->withErrors(trans('auth.failed'))
                    ->withInput();
        endif;
        
        $user = Auth::getProvider()->retrieveByCredentials($credentials);
        Auth::login($user, $request->get('remember'));

        return redirect()->intended('blog');
    }
    public function dashboard(){
       /* $name = "Guest";
        if(Auth::check()){
            $name = Auth::user()->name;
        }
        */
        $users = User::select('name', 'email', 'created_at')
                    ->OrderBy('name')
                    ->paginate(5);

        //return $users;
        return view('blog.dashboard', ['users' => $users]);
    }
    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }

    public function forgotPassword(){
        return view('auth.forgot-password');
    }

    public function tempPassword(Request $request){
       $request->validate([
            'email' => 'required|email|exists:users'
       ]);

       $user = User::where('email', $request->email)->first();
      // $user = $user[0];
       $userId = $user->id;
       $tempPassword = str::random(25);
       $user->temp_password =  $tempPassword;
       $user->save();

       $to_name  = $user->name;
       $to_email = $request->email;
       $body = "<a href='".route('new.password', [$userId, $tempPassword])."'>Click here to reset your password</a>";


       Mail::send('email.mail', ['name' => $to_name, 'body' => $body],
       function($message) use ($to_name, $to_email){
           $message->to($to_email, $to_name)->subject('Reset Password');
       }
   );

       return redirect()->back()->withSuccess("Please check your email account!");

        // return $request->email;
    }

    public function newPassword(User $user, $tempPassword){
        if ($user->temp_password === $tempPassword){
            return view('auth.new-password');
        }
        return redirect(route('forgot.password'))->withErrors('Credentials does not match!');
    }

    public function storeNewPassword(User $user, $tempPassword, Request $request){
        if ($user->temp_password === $tempPassword){
            $request->validate([
                'password' => 'required|min:6|max:20|confirmed'
            ]);
            $user->password = Hash::make($request->password);
            $user->temp_password = NULL;
            $user->save();
            return redirect(route('login'))->withSuccess('Password Changed with Success !');
        }
        return redirect(route('forgot.password'))->withErrors('Credentials does not match!');
    }
}
