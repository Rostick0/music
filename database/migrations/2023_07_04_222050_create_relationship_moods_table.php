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
        Schema::create('relationship_moods', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // playlist|music
            $table->integer('type_id');
            $table->foreignId('mood_id')->references('id')->on('moods')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relationship_moods');
    }
};
