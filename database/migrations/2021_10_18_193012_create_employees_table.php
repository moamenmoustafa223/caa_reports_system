<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_employees_id')->constrained()->cascadeOnDelete();
            $table->string('image')->default('avatar.png');

            $table->string('name_ar');
            $table->string('name_en');

            $table->string('employee_no')->unique();
            $table->date('Join_date')->nullable();

            $table->string('phone')->unique();
            $table->string('email')->nullable();
            $table->string('password',255);
            $table->rememberToken();

            $table->string('Nationality')->nullable();
            $table->string('id_number')->nullable();
            $table->boolean('status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
