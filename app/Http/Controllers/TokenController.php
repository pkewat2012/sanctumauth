<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class TokenController extends Controller
{
    public function index(Request $request){
       
        
        if(Auth::attempt(['email' => $request->username, 'password' => $request->password])) 
        {
            $user = Auth::user();
            $success['token'] =  $request->user()->createToken('MyApp')->plainTextToken;
       
            return ['user'=>$user,'token' =>  $success['token']];

       
        }
        return response()->json(['error'=>'Unauthorised'], 401);


}

public function get_users(){
    $user = User::all();
    return ['user'=>$user];
} 

public function revoke_token(){
    $user = Auth::user();
    $user->tokens()->delete();
    return response()->json(['msg'=>'Token Revoked'], 200);
}
}
