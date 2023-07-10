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
        Schema::create('privacy_impact_assessment', function (Blueprint $table) {
            $table->id('PrivacyImpactAssessmentID');
            $table->unsignedBigInteger('UserID');
            $table->string('Author');
            $table->unsignedBigInteger('Version');
            $table->string('ProcessName');
            $table->boolean('CheckMark')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('privacy_impact_assessment');
    }
};
