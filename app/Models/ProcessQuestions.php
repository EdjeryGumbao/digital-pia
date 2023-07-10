<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;

class ProcessQuestions extends Model
{
    use HasFactory, Sortable;

    protected $table = 'process_questions';

    protected $primaryKey = 'ProcessQuestionsID';

    protected $fillable = [
        'QuestionSetName',
        'SectionATitle',
        'SectionBTitle',
        'SectionCTitle',
        'SectionDTitle',
    ];

    protected $casts = [
        'SectionAQuestions' => 'array',
        'SectionBQuestions' => 'array',
        'SectionCQuestions' => 'array',
        'SectionDQuestions' => 'array',
    ];

    public $sortable = ['ProcessQuestionsID'];
}
