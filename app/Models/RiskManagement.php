<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskManagement extends Model
{
    use HasFactory;

    protected $primaryKey = 'RiskManagementID';
    
    protected $fillable = [
        'PrivacyImpactAssessmentID',
        'ThreatsVulnerabilities',
        'Impact',
        'Probability',
        'RiskRating',
    ];
}
