<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = ['email', 'youtube_video_id', 'code', 'waiting'];
}
