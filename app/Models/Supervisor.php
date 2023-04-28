<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'supervisor_users';
    protected $fillable =  ['full_name','role_id','password','user_name','company_name','company_position','contact_number','email','status'];
}
