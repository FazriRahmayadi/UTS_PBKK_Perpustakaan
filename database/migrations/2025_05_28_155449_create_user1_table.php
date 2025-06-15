<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('user1', function (Blueprint $table) {
            $table->string('user_id')->primary();
            $table->string('name', 50);
            $table->string('username')->unique();
            $table->string('email', 50);
            $table->char('password', 50);
            $table->date('membership_date');
            $table->timestamps();
        });
    }

   
    public function down(): void
    {
        Schema::dropIfExists('user1');
    }
};
