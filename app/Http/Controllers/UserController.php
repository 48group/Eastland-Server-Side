<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public $restful = true;

    public function register(Request $request)
    {
        $input = $request->json()->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return response()->json(['errorMessage' => $error],404);
        }
        DB::table('users')->insert([
                'name' => $input['name'] ,
                'email' => $input['email'] ,
                'password' => Hash::make($input['password']),
                'saleAlert' => true ,
                'type' => 'user'
            ]
        );
        return response()->json(['message' => 'user has been registered']);
    }

    public function login(Request $request)
    {
        $input = $request->json()->all();
        $validator = Validator::make($input, [
            'email' => 'required|email',
            'password' => 'required',
            'deviceId' => 'required'
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->all();
            return response()->json(['errorMessage' => [$error]], 404);
        }
        $deviceId = $input['deviceId'];
        $result = DB::table('users')
            ->where('email', $input['email'])
            ->first();
        if ($result && Hash::check($input['password'], $result->password)) {
            $res = DB::table('tokens')
                ->where('deviceId' , $deviceId)
                ->first();
            if($res)
            {
                $token = Token::find($res->id);
                $token->token =  bin2hex(openssl_random_pseudo_bytes(64));
                $token->save();
            }
            else
            {
                DB::table('tokens')->insert(
                    [
                        'token' => bin2hex(openssl_random_pseudo_bytes(64)),
                        'userId' => $result->id,
                        'deviceId' => $deviceId
                    ]
                );
            }
            $token = DB::table('tokens')->select('token')
                ->where('userId', $result->id)
                ->where('deviceId' , $deviceId)
                ->first();
            if($token)
            {
                return response()->json($token);
            }
            else
            {
                return response()->json(['errorMessage' => 'login failed'], 404);
            }
        } else {
            return response()->json(['errorMessage' => 'this user not found'], 404);
        }
    }



    public function logout($token,$deviceId)
    {
        $logout = DB::table('tokens')
            ->where('token' , $token)
            ->where('deviceId' , $deviceId)
            ->delete();
        if($logout)
        {
            return response()->json(["message" => "logged out"]);
        }
        else
        {
            return response()->json(['errorMessage' => 'log out has failed'],404);
        }
    }

}
