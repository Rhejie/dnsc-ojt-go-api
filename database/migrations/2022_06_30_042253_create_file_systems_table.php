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
        Schema::create('file_systems', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(false);
            $table->boolean('isView')->default(false);
            $table->boolean('isRejected')->default(false);
            $table->date('date_rejected')->nullable();
            $table->string('file_name');
            $table->string('file_path')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('file_requirement_id')->constrained('file_requirements')->onDelete('cascade');
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
        Schema::dropIfExists('file_systems');
    }
};
