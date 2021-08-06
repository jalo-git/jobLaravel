<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class ResumeController extends Controller
{

  public function store(Request $request, User $user, $jobId)
  {

    $validator = Validator::make($request->all(), [
      'firstname' => 'required',
      'lastname' => 'required',
      'age' => 'required',
      'gender' => 'required',
      'number' => 'required',
      'education' => 'required',
      'previousJob' => 'required',
      'company' => 'required',
      'skills' => 'required',
      'reference' => 'required',
      'contactNumber' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json(['error' => $validator->errors()]);
    } else {

      try {
        $postArray = $validator->validated();
        $postArray['job_id'] = $jobId;
        $applied = $user->resume()->create($postArray);
        return response()->json([
          'status' => 'success',
          'data' => $applied,
        ]);
      } catch (\Exception $e) {
        return response()->json([
          'status' => 'errors',
          'response' => $e,
        ]);
      }
    }
  }

  public function getApplicants()
  {
    $resume = Resume::with('user', 'job')->get();
    return response()->json($resume, 200);
  }

  public function deleteApplicants($id){
    $applicants = Resume::where('id', $id)->delete();
      return $applicants;
  }
}
