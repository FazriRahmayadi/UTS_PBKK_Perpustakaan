<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->string('author_id')->primary();
            $table->string('name');
            $table->string('nationality');
            $table->string('birthdate');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};
