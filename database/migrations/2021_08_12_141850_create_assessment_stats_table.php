<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssessmentStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assessment_stats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topic_id')->constrained();
            $table->foreignId('assessment_id')->constrained();
            $table->integer('topic_employee_score');
            $table->integer('topic_total_questions');
            $table->double('topic_performance',3,1)->nullable();
            $table->string('should_recap_topic')->nullable();
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
        Schema::dropIfExists('assessment_stats');
    }
}
