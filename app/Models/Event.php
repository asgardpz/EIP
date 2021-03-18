<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'start', 'end','event_plant','event_meal','event_item','event_jobid','event_type','event_count','event_menu_id'
    ];
}
