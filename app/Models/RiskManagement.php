<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiskManagement extends Model
{
    use HasFactory;

    protected $table = 'risk_management';

    protected $primaryKey = 'RiskManagementID';
    
    protected $fillable = [
        'PrivacyImpactAssessmentID',
        'ThreatsVulnerabilities',
        'Impact',
        'Probability',
        'RiskRating',
    ];
}
