<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;

class Recommendation extends Model
{
    use HasFactory, Sortable;

    protected $table = 'recommendation';

    protected $primaryKey = 'RecommendationID';
    
    protected $fillable = [
        'PrivacyImpactAssessmentID',
        'Recommendation',
        'Priority',
    ];

    public $sortable = ['Recommendation', 'Priority', 'created_at', 'updated_at'];
}
