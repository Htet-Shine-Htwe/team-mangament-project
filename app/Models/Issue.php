<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status_id',
        'workspace_id',
        'creator_id',
        'assign_id',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
