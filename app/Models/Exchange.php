<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exchange extends Model
{
    use HasFactory;

    protected $fillable = ['offered_by', 'offered_post_id', 'requested_post_id', 'status'];

    public function offeredBy()
    {
        return $this->belongsTo(User::class, 'offered_by');
    }

    public function offeredPost()
    {
        return $this->belongsTo(Post::class, 'offered_post_id');
    }

    public function requestedPost()
    {
        return $this->belongsTo(Post::class, 'requested_post_id');
    }
}
