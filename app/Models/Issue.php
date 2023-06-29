<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;

    protected $cast = [
        'due_date' => 'datetime',
    ];
    protected $fillable = [
        'title',
        'description',
        'status_id',
        'workspace_id',
        'creator_id',
        'assign_id',
        'due_date',
        'link_url',
        'link_title',
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function issueImages()
    {
        return $this->hasMany(IssuePhoto::class);
    }
}
