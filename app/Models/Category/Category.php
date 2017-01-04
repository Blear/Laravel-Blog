<?php

namespace App\Models\Category;

use App\Models\Category\Traits\Attribute\CategoryAttribute;
use App\Models\Category\Traits\Relationship\CategoryRelationship;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    use CategoryAttribute,
        CategoryRelationship;

    protected $table='categories';
    protected $fillable=['name','sort','parent_id'];
}
