<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataFlow extends Model
{
    use HasFactory;

    protected $primaryKey = 'DataFlowID';
    
    protected $fillable = [
        'PrivacyImpactAssessmentID',
        'FileName',
    ];
}
