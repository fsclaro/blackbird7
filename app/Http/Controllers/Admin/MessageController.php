<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MessageController extends Controller
{
    use SoftDeletes;

    protected $date = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id_sender',
        'user_id_destination',
        'subject',
        'content',
        'is_redad'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }
    
}
