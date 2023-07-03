<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Issue extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        // static::saving(function ($model) {
        //     $model->slug = Str::slug($model->title);
        // });
    }

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

    public function getSlugAttribute()
    {
        return Str::slug($this->title);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function issueImages()
    {
        return $this->hasMany(IssuePhoto::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
}
