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
        Schema::create('coordinator_users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->integer('role_id');
            $table->string('user_name');
            $table->string('password');
            $table->string('course_handled');
            $table->string('contact_number');
            $table->string('email');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coordinator_users');
    }
};
