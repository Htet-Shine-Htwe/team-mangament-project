<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Workspace extends Model
{
    use HasFactory;

    protected $fillable = ['name','hax_color','logo_path'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_workspace');

    }


}
