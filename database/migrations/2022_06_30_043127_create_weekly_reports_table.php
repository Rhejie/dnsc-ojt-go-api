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
        Schema::create('weekly_reports', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->string('file_path')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->boolean('isView')->default(false);
            $table->boolean('isRejected')->default(false);
            $table->date('date_rejected')->nullable();
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
        Schema::dropIfExists('weekly_reports');
    }
};
