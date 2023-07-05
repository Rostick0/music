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
        Schema::create('remove_claims', function (Blueprint $table) {
            $table->id();
            $table->string('link');
            $table->string('status')->default('обрабатывается');
            $table->foreignId('music_id')->references('id')->on('music')->onDelete('cascade');
            $table->foreignId('users_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('remove_claims');
    }
};
