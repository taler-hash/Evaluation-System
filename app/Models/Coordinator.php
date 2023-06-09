<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinator extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'coordinator_id';
    protected $table = 'coordinator_users';

    protected $fillable = ['full_name','role_id' ,'user_name','password', 'course_handled','contact_number','email','status'];
    
}
