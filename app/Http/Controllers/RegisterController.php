<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Controllers\Controller; 

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 


class RegisterController extends Controller
{

   
       private $apiToken;
       public function __construct()
        {
        $this->apiToken = uniqid(base64_encode(Str::random(40)));
        }
      /** 
       * Register API 
       * 
       * @return \Illuminate\Http\Response 
       */ 
      public function register(Request $request) 
      { 
                            
        $validator = Validator::make($request->all(), [ 
          'firstname' => 'required', 
          'lastname' => 'required', 
          'address' => 'required', 
          'emailAddress' => 'required|email', 
          'password' => 'required', 
        ]);
        if ($validator->fails()) { 
          return response()->json(['error'=>$validator->errors()]);
        }
        $postArray = $request->all(); 
       
        $postArray['password'] = bcrypt($postArray['password']); 
        $postArray['usertype'] = 'customer'; 
        $user = User::create($postArray); 
        
        $success['token'] = $this->apiToken;	
        $success['name'] =  $user->name;
        return response()->json([
          'status' => 'success',
          'data' => $success,
        ]); 
      }


      public function login(Request $request)
      {
          $data = User::where('emailAddress', $request->emailAddress)->first();
  
          if(!$data || !Hash::check($request->password,$data->password)){
              return response(
                  ["Message"=>"Login failed"], 400
              );
          }
          $token = $data->createToken('job-token')->plainTextToken;
  
          $response=[
              'message'=> "Login Successfully!",
              'logincredential' => $data,
              'token' => $token
  
          ];
  
          return response($response, 200);
      }
      public function logout(Request $request)
    {
        $response = [];

        try
        {
            $request->user()->currentAccessToken()->delete();

            $response['message']='Logout successfully!';
            $response['code']=200;
        }
        catch(\Exception $e)
        {
            $response['message']='Logout failed!';
            $response['code'] = 400;
        }

        return response($response, $response['code']);

    }
  
}
