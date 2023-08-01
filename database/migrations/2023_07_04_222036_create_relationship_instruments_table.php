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
        Schema::create('relationship_instruments', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // playlist|music
            $table->integer('type_id');
            $table->foreignId('instrument_id')->references('id')->on('instruments')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relationship_instruments');
    }
};
