<?php
namespace App\Models\Permission;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: Blear
 * Date: 2016/12/21
 * Time: 12:29
 */
class Permission extends Model
{
    protected $table="permissions";
    protected $fillable = ['name', 'display_name', 'sort'];
}