<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\Resume;
class Job extends Model
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'jobName',
        'salary',
        'option',
        'image',
        'description',
    
    ];


    public function user()
    {
        return $this->belongsToMany(User::class, 'resumes', 'user_id', 'job_id');
    }
 
}
