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
        Schema::create('student_leave_rquests', function (Blueprint $table) {
            $table->id();
            $table->string('leave_type');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('duration');
            $table->string('status');
            $table->string('reason');
            $table->foreignId('student_id')->constrained()->onDelete('CASCADE');
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
        Schema::dropIfExists('student_leave_rquests');
    }
};
