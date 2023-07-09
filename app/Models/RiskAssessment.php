<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskAssessment extends Model
{
    use HasFactory;

    protected $table = 'risk_assessment';

    protected $primaryKey = 'RiskAssessmentID';
    
    protected $fillable = [
        'PrivacyImpactAssessmentID',
        'ThreatsVulnerabilities',
        'Impact',
        'Probability',
        'RiskRating',
    ];
}
