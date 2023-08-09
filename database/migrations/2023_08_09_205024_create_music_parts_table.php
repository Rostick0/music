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
        Schema::create('music_parts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('music_id')->references('id')->on('music')->onDelete('cascade');
            $table->string('name');
            $table->string('link');
            $table->time('duration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('music_parts');
    }
};
