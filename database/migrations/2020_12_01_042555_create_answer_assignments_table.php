<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('assignment_id');
            $table->foreign('assignment_id')->references('id')->on('assignments');
            $table->unsignedBiginteger('student_user_id');
            $table->foreign('student_user_id')->references('id')->on('users');
            $table->string('document');
            $table->string('remarks')->nullable();
            $table->bigInteger('marks_allocated')->nullable();
            $table->string('type');
            $table->unsignedBigInteger('subject_id');
            $table->foreign('subject_id')->references('id')->on('subjects');
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
        Schema::dropIfExists('answer_assignments');
    }
}
