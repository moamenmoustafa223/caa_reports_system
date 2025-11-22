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
        Schema::create('severity_levels', function (Blueprint $table) {
            $table->id();
            $table->string('level_key')->unique();
            $table->string('name_ar');
            $table->string('name_en');
            $table->integer('order')->default(0);
            $table->string('color')->default('#6c757d');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('severity_levels');
    }
};
