<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\supervisor;

class Student extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'student_id';
    protected $table = 'student_users';

    public function supervisor(){
        return $this->belongsTo(supervisor::class, 'company_name', 'company_name');
    }
}
