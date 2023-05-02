<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\supervisor;
use App\Models\Comment;
use App\Models\Portfolio;

class Student extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'student_id';
    protected $table = 'student_users';

    public function supervisor(){
        return $this->belongsTo(supervisor::class, 'company_name', 'company_name');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'student_number', 'student_number');
    }

    public function portfolio(){
        return $this->belongsTo(Portfolio::class,'student_number', 'student_number');
    }
}
