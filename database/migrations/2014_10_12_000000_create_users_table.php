<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('suffix')->nullable();
            $table->string('gender')->nullable()->comment('male', 'female');
            $table->string('phone_number')->nullable();
            $table->text('address')->nullable();
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('course_id')->nullable();
            $table->unsignedBigInteger('institute_id')->nullable();
            $table->unsignedBigInteger('agency_department_id')->nullable();
            $table->string('email')->unique();
            $table->string('username');
            $table->string('student_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->date('deploy_date')->nullable();
            $table->rememberToken();
            $table->softdeletes();
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
        Schema::dropIfExists('users');
    }
};
