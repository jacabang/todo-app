<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TodoModel extends Model
{
    //
    protected $table = 'todo';
    use SoftDeletes;

    protected $fillable = [
        'todo',
        'remarks',
        'sDate',
        'eDate',
        'created_by',
        'completed_at',
    ];
}
