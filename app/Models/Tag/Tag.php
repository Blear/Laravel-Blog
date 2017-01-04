<?php

namespace App\Models\Tag;

use App\Models\Tag\Traits\Attribute\TagAttribute;
use App\Models\Tag\Traits\Relationship\TagRelationship;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    use TagAttribute,
        TagRelationship;
    protected $table='tags';
    protected $fillable=['name'];
}
