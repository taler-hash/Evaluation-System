<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deadline extends Model
{
    use HasFactory;
    protected $table = 'deadline';
    public $timestamps = false;
    protected $fillable = ['date','batch_year'];
}
