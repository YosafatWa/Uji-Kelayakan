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
        Schema::create('response_progresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('response_id')->constrained()->onDelete('cascade');
            $table->foreignId('report_id')->constrained()->onDelete('cascade');
            $table->json('histories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.  
     */
    public function down(): void
    {
        Schema::dropIfExists('response_progresses');
    }
};