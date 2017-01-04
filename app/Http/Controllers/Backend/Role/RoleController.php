<?php

namespace App\Http\Controllers\Backend\Role;

use App\Http\Requests\Backend\Role\ManageRoleRequest;
use App\Http\Requests\Backend\Role\StoreRoleRequest;
use App\Http\Requests\Backend\Role\UpdateRoleRequest;
use App\Models\Role\Role;
use App\Repositories\Backend\Permission\PermissionRepository;
use App\Repositories\Backend\Role\RoleRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    protected $roles;
    protected $permissions;
    public function __construct(RoleRepository $roles,PermissionRepository $permissions)
    {
        $this->roles=$roles;
        $this->permissions=$permissions;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManageRoleRequest $request)
    {
        //
        return view('backend.role.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ManageRoleRequest $request)
    {
        //
        return view('backend.role.create')
            ->withPermissions($this->permissions->getAll())
            ->withRoleCount($this->roles->getCount());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        //
        $this->roles->create($request->all());
        return redirect()->route('admin.role.index')->withFlashSuccess('角色添加成功!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role,ManageRoleRequest $request)
    {
        //
        return view('backend.role.edit')
            ->withRole($role)
            ->withRolePermissions($role->permissions->pluck('id')->all())
            ->withPermissions($this->permissions->getAll());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Role $role,UpdateRoleRequest $request)
    {
        //
        $this->roles->update($role,$request->all());
        return redirect()->route('admin.role.index')->withFlashSuccess('角色修改成功!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role,ManageRoleRequest $request)
    {
        //
        $this->roles->delete($role);
        return redirect()->route('admin.role.index')->withFlashSuccess('角色删除成功!');
    }
}
