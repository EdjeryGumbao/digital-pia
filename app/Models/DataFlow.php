<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;

class DataFlow extends Model
{
    use HasFactory, Sortable;

    protected $table = 'data_flow';

    protected $primaryKey = 'DataFlowID';
    
    protected $fillable = [
        'PrivacyImpactAssessmentID',
        'FileName',
    ];

    public $sortable = ['created_at', 'updated_at'];
}