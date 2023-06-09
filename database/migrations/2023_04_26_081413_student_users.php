<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_users', function (Blueprint $table) {
            $table->id();
            $table->string('student_number')->unique();
            $table->string('full_name');
            $table->integer('role_id');
            $table->string('user_name');
            $table->string('password');
            $table->string('batch_year');
            $table->string('email');
            $table->string('contact_number');
            $table->string('course');
            $table->string('status');
            $table->string('company_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_users');
    }
};
