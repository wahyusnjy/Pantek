<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    //Fungsi Untuk Register
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required','string'],
            'email' => ['required','string','unique:users,email'],
            'password' => ['required','string'],
        ]);
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);
        return $this->_token($user);
    }
    //Fungsi Untuk Login
    public function login(Request $request){
        $request->validate([
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Check if email exist
       $user = User::where('email',$request->email)->first();
        
        //check if password match
        if(!$user || !Hash::check($request->password, $user->password)){
            return response([
                'message' => 'Credential does not match'
            ]);
        }
        
      return $this-> _token($user);
    
    }

    //Fungsi untuk Log Out
    public function logout(Request $request) {
       
        auth()->user()->tokens()->delete();

        return response('User Logged Out Successfully', 200);
    }

    protected function _token($user) {
        $token = $user->createToken('outapptoke')->plainTextToken;

        $response = ['user' => $user, 'token' => $token];

        return response($response,201);
    }

}
