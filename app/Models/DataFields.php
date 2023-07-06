<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataFields extends Model
{
    use HasFactory;

    protected $table = 'data_fields';

    protected $primaryKey = 'DataFieldsID';
    
    protected $fillable = [
        'PrivacyImpactAssessmentID',
        'FormUsed',
        'Datacollected',
    ];

    protected $casts = [
        'Datacollected' => 'array',
    ];
}
