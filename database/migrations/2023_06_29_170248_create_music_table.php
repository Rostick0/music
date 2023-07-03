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
        Schema::create('music', function (Blueprint $table) {
            $table->id();
            $table->foreignId('music_artists_id')->references('id')->on('music_artists')->onDelete('cascade');
            $table->string('title');
            $table->string('link');
            $table->string('link_demo');
            $table->string('publisher')->nullable();;
            $table->string('distr')->nullable();;
            $table->string('genres_id')->references('id')->on('genres')->onDelete('cascade');
            $table->boolean('is_active')->default(0);
            $table->boolean('is_free')->default(0);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('music');
    }
};
