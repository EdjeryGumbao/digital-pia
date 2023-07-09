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
        Schema::create('process', function (Blueprint $table) {
            $table->id('ProcessID');
            $table->unsignedBigInteger('PrivacyImpactAssessmentID');
            $table->string('ProcessName')->nullable();
            $table->string('DataSubject')->nullable();
            $table->longText('PurposeforProcessing')->nullable();
            $table->longText('SecurityMeasure')->nullable();
            $table->longText('ProcessNarrative')->nullable();
            $table->json('SectionA')->nullable();
            $table->json('SectionB')->nullable();
            $table->json('SectionC')->nullable();
            $table->json('SectionD')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('process');
    }
};
