<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Job;
use App\Models\User;
class Resume extends Model

{
    use HasFactory,Notifiable;

    protected $fillable = [
        'job_id',
        'firstname',
        'lastname',
        'age',
        'gender',
        'number',
        'education',
        'previousJob',
        'company',
        'skills',
        'reference',
        'contactNumber',
    
    ];

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id' , 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
