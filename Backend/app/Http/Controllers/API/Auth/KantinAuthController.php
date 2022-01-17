<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\Kantin;
use Illuminate\Http\Request;

class KantinAuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required','string'],
            'email' => ['required','string','unique:users,email'],
            'password' => ['required','string'],
        ]);
        $user = Kantin::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);
        return $this->_token($user);
    }
}
