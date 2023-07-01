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
        Schema::create('site_banners', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->default('<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none"><g stroke="#fff" stroke-linejoin="round" stroke-width="2" clip-path="url(#a)"><path stroke-linecap="round" d="M15 16.875v7.5M11.25 20.625h7.5"/><path d="M27.188 4.688H2.813c-1.036 0-1.876.839-1.876 1.875v20.625c0 1.035.84 1.875 1.875 1.875h24.375c1.036 0 1.875-.84 1.875-1.875V6.563c0-1.036-.839-1.875-1.875-1.875ZM.938 12.188h28.125"/><path stroke-linecap="round" d="M8.438 7.5V.937M21.563 7.5V.937"/></g><defs><clipPath id="a"><path fill="#fff" d="M0 0h30v30H0z"/></clipPath></defs></svg>');
            $table->string('style')->default('padding: 20px 0, linear-gradient(264deg, #FF9211 0%, #FF1111 100%)');
            $table->text('text');
            $table->string('button_text');
            $table->string('button_link');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_banners');
    }
};
