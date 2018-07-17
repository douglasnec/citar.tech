<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use Notifiable;

    protected $table = 'country';
    protected $fillable = ['initial', 'name'];
    protected $hidden = [];
}
