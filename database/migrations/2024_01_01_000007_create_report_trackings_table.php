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
        Schema::create('report_trackings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained('reports')->onDelete('cascade');
            $table->foreignId('status_id')->constrained('report_statuses')->onDelete('cascade');
            $table->text('comment')->nullable();
            $table->foreignId('changed_by_admin_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('changed_by_employee_id')->nullable()->constrained('employees')->onDelete('set null');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_trackings');
    }
};
