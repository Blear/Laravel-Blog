<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    protected $table='settings';
    public $timestamps=false;
    protected $fillable=[
        'key',
        'value',
        'tag'
    ];
}
