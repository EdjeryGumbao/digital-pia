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
        Schema::create('process_questions', function (Blueprint $table) {
            $table->id('ProcessQuestionsID');
            $table->string('QuestionSetName')->nullable();
            $table->string('SectionATitle')->nullable();
            $table->string('SectionBTitle')->nullable();
            $table->string('SectionCTitle')->nullable();
            $table->string('SectionDTitle')->nullable();
            
            $table->json('SectionAQuestions')->nullable();
            $table->json('SectionBQuestions')->nullable();
            $table->json('SectionCQuestions')->nullable();
            $table->json('SectionDQuestions')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('process_questions');
    }
};
