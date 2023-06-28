<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssuePhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'issue_id',
    ];


}
