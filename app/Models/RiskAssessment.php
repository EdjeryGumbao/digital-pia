<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;

class RiskAssessment extends Model
{
    use HasFactory, Sortable;

    protected $table = 'risk_assessment';

    protected $primaryKey = 'RiskAssessmentID';
    
    protected $fillable = [
        'PrivacyImpactAssessmentID',
        'ThreatsVulnerabilities',
        'Impact',
        'Probability',
        'RiskRating',
    ];

    public $sortable = ['ThreatsVulnerabilities', 'RiskRating', 'created_at', 'updated_at'];
}
