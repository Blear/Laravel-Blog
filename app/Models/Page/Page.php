<?php

namespace App\Models\Page;

use App\Models\Page\Traits\Attribute\PageAttribute;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //
    use PageAttribute;
    protected $table='pages';
    protected $fillable=[
        'title',
        'slug',
        'content_original',
        'content',
    ];
}
