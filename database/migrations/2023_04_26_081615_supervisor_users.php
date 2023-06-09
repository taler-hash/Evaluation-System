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
        Schema::create('supervisor_users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->integer('role_id');
            $table->string('password');
            $table->string('user_name');
            $table->string('company_name');
            $table->string('company_position');
            $table->string('contact_number');
            $table->string('course_handled');
            $table->string('email');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supervisor_users');
    }
};
