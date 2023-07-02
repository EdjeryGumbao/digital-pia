<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    use HasFactory;

    protected $primaryKey = 'ProcessID';
    
    protected $fillable = [
        'PrivacyImpactAssessmentID',
        'ProcessName',
        'DataSubject',
        'DataFieldsID',
        'PurposeforProcessing',
        'SecurityMeasure',
        'ProcessNarrative',
        'SectionAQuestion',
        'SectionBQuestion',
        'SectionCQuestion',
        'SectionDQuestion',
        'SectionA',
        'SectionB',
        'SectionC',
        'SectionD',
    ];
}
