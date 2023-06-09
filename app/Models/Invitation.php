<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'email',
        'sender_id',
        'workspace_id',
        'status'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function workspace()
    {
        return $this->belongsTo(Workspace::class, 'workspace_id');
    }

    public function getReceiver(string $email)
    {
        return User::where('email', $email)->first();
    }
}
