<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivacyImpactAssessmentVersion extends Model
{
    use HasFactory;
    protected $table = 'privacy_impact_assessment_version';

    protected $primaryKey = 'PrivacyImpactAssessmentVersionID';

    protected $fillable = [
        'IsActive',
        'Version',
    ];
}
