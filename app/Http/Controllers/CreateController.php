<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class CreateController extends Controller
{
    public function create(Request $request) 
    { 
                          
      $validator = Validator::make($request->all(), [ 
        'jobName' => 'required', 
        'salary' => 'required', 
        'option' => 'required', 
        'image' => 'required', 
        'description' => 'required'
      ]);
      if ($validator->fails()) { 
        return response()->json(['error'=>$validator->errors()]);
      }
      $postArray = $request->all(); 
      $user = Job::create($postArray); 
      
    //   $success['token'] = $this->apiToken;	
      $success['name'] =  $user->name;
      return response()->json([
        'status' => 'success',
        'data' => $user,
      ]); 
    }


    public function getAllJobs(){
      return response()->json(Job::all(),200);
    }


    public function destroy($id){
      DB::table('jobs')->where('id', $id)->delete();
    }



    public function getUpadateById(Request $request, $id){
      $job = Job::find($id);
      if(is_null($job)){
        return response()->json(['message' => 'Job not found'],404);
        
      }
      $job->update($request->all());
      return response($job,200);

    }




    public function updatedJob(Request $request, $id){
      $job = Job::find($id);
      if(is_null($job)){
        return response()->json(['message' => 'Job not found'],404);
        
      }
      $job->update($request->all());
      return response($job,200);

    }
  
}