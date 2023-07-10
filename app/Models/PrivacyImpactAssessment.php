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
        'UserID',
        'Author',
        'Version',
        'ProcessName',
        'CheckMark',
    ];

    public $sortable = ['Version', 'ProcessName', 'created_at', 'updated_at', 'Author', 'CheckMark'];
}
