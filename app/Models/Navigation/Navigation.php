<?php

namespace App\Models\Navigation;

use App\Models\Navigation\Traits\Attribute\NavigationAttribute;
use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    //
    use NavigationAttribute;
    protected $table='navigations';
    protected $fillable=[
        'name',
        'sort',
        'href',
        'target'
    ];
}
