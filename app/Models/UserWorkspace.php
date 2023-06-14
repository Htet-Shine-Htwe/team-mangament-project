<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Auth;

class UserWorkspace extends Pivot
{
    use HasFactory;


    protected $fillable = ['user_id','workspace_id','role_id'];

     public function scopeGetUserWorkspaces($query)
    {
        return $query->select('workspaces.name', 'workspaces.logo_path')
            ->where('user_id', Auth::user()->id)
            ->join('workspaces', 'user_workspace.workspace_id', '=', 'workspaces.id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
