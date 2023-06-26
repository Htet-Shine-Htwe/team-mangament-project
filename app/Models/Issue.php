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
        'label_id',
        'workspace_id',
        'creator_id',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
