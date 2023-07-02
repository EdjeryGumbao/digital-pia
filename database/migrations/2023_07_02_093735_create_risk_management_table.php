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
        Schema::create('risk_management', function (Blueprint $table) {
            $table->id('RiskManagementID');
            $table->unsignedBigInteger('PrivacyImpactAssessmentID');
            $table->string('ThreatsVulnerabilities');
            $table->integer('Impact');
            $table->integer('Probability');
            $table->integer('RiskRating');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('risk_management');
    }
};
