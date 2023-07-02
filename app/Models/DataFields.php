<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataFields extends Model
{
    use HasFactory;

    protected $primaryKey = 'DataFieldsID';
    
    protected $fillable = [
        'ProcessID',
        'FormUsed',
        'Datacollected',
    ];
}
