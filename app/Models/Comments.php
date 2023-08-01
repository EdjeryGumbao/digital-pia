<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;

class Comments extends Model
{
    use HasFactory, Sortable;

    protected $table = 'comments';

    protected $primaryKey = 'CommentsID';
    
    protected $fillable = [
        'PrivacyImpactAssessmentID',
        'UserID',
        'Message',
        'Status',
    ];

    public $sortable = ['UserID', 'RiskRating', 'created_at'];
}
