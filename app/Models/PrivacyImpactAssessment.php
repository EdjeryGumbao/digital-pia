<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivacyImpactAssessment extends Model
{
    protected $primaryKey = 'PrivacyImpactAssessmentID';

    protected $fillable = [
        'UserID',
        'PrivacyImpactAssessmentVersionID',
        'Name',
    ];
}
