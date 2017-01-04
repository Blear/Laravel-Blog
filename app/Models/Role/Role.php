<?php
namespace App\Models\Role;
use App\Models\Role\Traits\Attribute\RoleAttribute;
use App\Models\Role\Traits\Relationship\RoleRelationship;
use App\Models\Role\Traits\RoleAccess;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/21
 * Time: 8:55
 */
class Role extends Model
{
    use RoleRelationship,
        RoleAttribute,
        RoleAccess;
    protected $table='roles';

    protected $fillable = ['name', 'all', 'sort'];
}