<?php

namespace App\Http\Controllers;

use App\Services\BrandService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psr\Log\LoggerInterface;

class AuthController extends Controller
{
    public function login(Request $request){
        if(Auth::attempt(['email'=> $request->email, 'password' => $request->password])){
            $user = Auth::user();
            $token = $user->createToken('JWT');

            return response()->json($token->plainTextToken, 200);
        }
        return response()->json('Usuario Invalido', 401);
        
    }
}
