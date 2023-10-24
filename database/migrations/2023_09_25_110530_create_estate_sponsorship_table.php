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
        Schema::create('estate_sponsorship', function (Blueprint $table) {
            $table->id();

            $table->foreignId('estate_id')->constrained()->onDelete('cascade');
            $table->foreignId('sponsorship_id')->constrained()->onDelete('cascade');
            $table->date('start')->nullable();
            $table->date('stop')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estate_sponsorship');
    }
};
