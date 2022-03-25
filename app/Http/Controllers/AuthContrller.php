<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth ;
use Tymon\JWTAuth\Contracts\Providers\Auth as ProvidersAuth;
use App\Models\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthContrller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api',['except'=>['login','register']]);
    }

    // public function register(Request $request) {
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|between:2,100',
    //         'email' => 'required|string|email|max:100|unique:users',
    //         'password' => 'required|string|confirmed|min:6',
    //     ]);

    //     if($validator->fails()){
    //          return response()->json($validator->errors()->toJson(), 400);
    //     }

    //     $user = User::create(array_merge(
    //                 $validator->validated(),
    //                 ['password' => bcrypt($request->password)]
    //             ));

    //     return response()->json([
    //         'message' => 'User successfully registered',
    //         'user' => $user
    //     ], 201);

    // }

    public function register(Request $request)
    {
    	//Validate data
        $data = $request->only('name', 'email', 'password');
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()], 400);
        }

        //Request is valid, create new user
        $user = User::create([
        	'name' => $request->name,
        	'email' => $request->email,
        	'password' => bcrypt($request->password)
        ]);

        //User created, return success response
        try {
            if (! $token = JWTAuth::attempt($data)) {
                return response()->json([
                	'success' => false,
                	'message' => 'Login credentials are invalid.',
                ], 400);
            }
        } catch (JWTException $e) {
    	return $data;
            return response()->json([
                	'success' => false,
                	'message' => 'Could not create token.',
                ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'token' => $token,
            'data' => $user
        ], Response::HTTP_OK);
    }
 


    // public function login(Request $request){
    //     $validator = Validator::make($request->all(), [
    //         'email' => 'required|email',
    //         'password' => 'required|string|min:6',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json($validator->errors(), 422);
    //     }

    //     if (! $token = auth()->attempt($validator->validated())) {
    //         return response()->json(['error' => 'Either email or password is wrong.'], 401);
    //     }
    //     return $this->CreateNewToken($token);
    // }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        //valid credential
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string|min:6|max:50'
        ]);

        //Send failed response if request is not valid
        if ($validator->fails()) {
            return response()->json(['error' => $validator->getMessageBag()], 400);
        }

        //Request is validated
        //Crean token
   
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json([
                	'success' => false,
                	'message' => 'Login credentials are invalid.',
                ], 400);
            }
        } catch (JWTException $e) {
    	return $credentials;
            return response()->json([
                	'success' => false,
                	'message' => 'Could not create token.',
                ], 500);
        }
 	
 		//Token created, return with success response and jwt token
        return response()->json([
            'success' => true,
            'token' => $token,
            'user'=>auth()->user(),
        ]);
    }
 
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    // public function logout(Request $request)
    // {
    //     //valid credential
    //     $validator = Validator::make($request->only('token'), [
    //         'token' => 'required'
    //     ]);

    //     //Send failed response if request is not valid
    //     if ($validator->fails()) {
    //         return response()->json(['error' => $validator->getMessageBag()], 200);
    //     }

	// 	//Request is validated, do logout        
    //     try {
    //         JWTAuth::invalidate($request->token);
 
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'User has been logged out'
    //         ]);
    //     } catch (JWTException $exception) {
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Sorry, user cannot be logged out'
    //         ], Response::HTTP_INTERNAL_SERVER_ERROR);
    //     }
    // }

    // public function profile(Request $request)
    // {
    //     $this->validate($request, [
    //         'token' => 'required'
    //     ]);
 
    //     $user = JWTAuth::authenticate($request->token);
 
    //     return response()->json(['user' => $user]);
    // }

    public function profile(){
        return response()->json(auth()->user());
    }


 
    // public function CreateNewToken($token){
    //     return response()->json([
    //         'access_token'=>$token,
    //         'token_type'=>'bearer',
    //         // 'expires_in' => $this->guard()->factory()->getTTL() * 60,
    //         // 'expires_in' => auth('api')->factory()->getTTL() * 60,
    //         'user'=>auth()->user(),
    //     ]);
    // }
}
