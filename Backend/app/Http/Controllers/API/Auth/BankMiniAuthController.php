<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Models\Bank_Mini;
use Illuminate\Http\Request;

class BankMiniAuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required','string'],
            'email' => ['required','string','unique:users,email'],
            'password' => ['required','string'],
        ]);
        $user = Bank_Mini::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);
        return $this->_token($user);
    }
}
