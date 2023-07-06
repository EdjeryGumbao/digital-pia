<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    use HasFactory;

    protected $table = 'process';

    protected $primaryKey = 'ProcessID';
    
    protected $fillable = [
        'PrivacyImpactAssessmentID',
        'ProcessName',
        'DataSubject',
        'DataFieldsID',
        'PurposeforProcessing',
        'SecurityMeasure',
        'ProcessNarrative',
        'SectionA',
        'SectionB',
        'SectionC',
        'SectionD',
    ];

    protected $casts = [
        'SectionA' => 'array',
        'SectionB' => 'array',
        'SectionC' => 'array',
        'SectionD' => 'array',
    ];
}
