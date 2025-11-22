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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('report_number')->unique();
            $table->foreignId('employee_id')->nullable()->constrained('employees')->onDelete('set null');
            $table->foreignId('location_id')->constrained('locations')->onDelete('cascade');
            $table->foreignId('severity_level_id')->constrained('severity_levels')->onDelete('cascade');
            $table->dateTime('report_date');
            $table->decimal('latitude', 10, 6)->nullable();
            $table->decimal('longitude', 10, 6)->nullable();
            $table->text('short_description');
            $table->foreignId('status_id')->constrained('report_statuses')->onDelete('cascade');
            $table->boolean('is_public')->default(0);
            $table->string('map_url')->nullable();
            $table->integer('attachments_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
