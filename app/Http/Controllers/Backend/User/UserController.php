<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Requests\Backend\User\ManageUserRequest;
use App\Http\Requests\Backend\User\StoreUserRequest;
use App\Http\Requests\Backend\User\UpdateUserRequest;
use App\Models\User\User;
use App\Repositories\Backend\Role\RoleRepository;
use App\Repositories\Backend\User\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $users;

    protected $roles;

    public function __construct(UserRepository $users,RoleRepository $roles)
    {
        $this->users=$users;
        $this->roles=$roles;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManageUserRequest $request)
    {
        //
        return view('backend.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ManageUserRequest $request)
    {
        //
        return view('backend.user.create')
            ->withRoles($this->roles->getAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        //
        $this->users->create(['data' => $request->except('assignees_roles'), 'roles' => $request->only('assignees_roles')]);
        return redirect()->route('admin.user.index')->withFlashSuccess('用户添加成功!');
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
    public function edit(User $user,ManageUserRequest $request)
    {
        //
        return view('backend.user.edit')
            ->withUser($user)
            ->withUserRoles($user->roles->pluck('id')->all())
            ->withRoles($this->roles->getAll());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user,UpdateUserRequest $request)
    {
        //
        $this->users->update($user,['data'=>$request->except('assignees_roles'),'roles'=>$request->only('assignees_roles')]);
        return redirect()->route('admin.user.index')->withFlashSuccess('用户信息更新成功!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user,ManageUserRequest $request)
    {
        //
        $this->users->delete($user);
        return redirect()->route('admin.user.deleted')->withFlashSuccess('用户删除成功!');
    }
}
