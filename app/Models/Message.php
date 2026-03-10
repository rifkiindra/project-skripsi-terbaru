<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'artwork_id',
        'from_id',
        'to_id',
        'message',
        'file_path',
        'type',
        'is_read',
        'is_delivered',
        'deleted_by_sender',
        'deleted_for_all',
    ];

    public function from()
    {
        return $this->belongsTo(\App\Models\User::class, 'from_id');
    }

    public function to()
    {
        return $this->belongsTo(\App\Models\User::class, 'to_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'from_id');
    }

}
