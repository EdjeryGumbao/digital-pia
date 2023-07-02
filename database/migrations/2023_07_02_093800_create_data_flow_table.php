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
        Schema::create('data_flow', function (Blueprint $table) {
            $table->id('DataFlowID');
            $table->unsignedBigInteger('PrivacyImpactAssessmentID');
            $table->string('FileName');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_flow');
    }
};
