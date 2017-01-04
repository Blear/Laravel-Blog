<?php

namespace App\Models\Link;

use App\Models\Link\Traits\Attribute\LinkAttribute;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    //
    use LinkAttribute;
    protected $table='links';
    protected $fillable=[
        'name',
        'href',
        'sort'
    ];
}
