<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'ip',
        'user_id',
        'referer',
        'url',
        'query_params',
        'user_agent',
        'method',
        'session_id',
        'device',
        'platform',
        'browser',
        'accept_language',
    ];
}
