<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;

class PrivacyImpactAssessment extends Model
{
    use HasFactory, Sortable;

    protected $table = 'privacy_impact_assessment';

    protected $primaryKey = 'PrivacyImpactAssessmentID';

    protected $fillable = [
        'PrivacyImpactAssessmentID',
        'PIAVersion',
        'UserID',
        'Department',
        'Author',
        'ProcessName',
        'Validated',
        'DateValidated',
    ];

    public $sortable = ['PrivacyImpactAssessmentID', 'PIAVersion', 'UserID', 'Department', 'Author', 'ProcessName',  'Validated', 'DateValidated', 'created_at', 'updated_at',];
}
