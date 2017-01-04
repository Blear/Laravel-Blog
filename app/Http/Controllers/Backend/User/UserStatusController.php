<?php

namespace App\Http\Controllers\Backend\User;

use App\Http\Requests\Backend\User\ManageUserRequest;
use App\Models\User\User;
use App\Repositories\Backend\User\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserStatusController extends Controller
{
    //
    protected $users;

    public function __construct(UserRepository $users)
    {
        $this->users=$users;
    }

    public function getDeactivated(ManageUserRequest $request)
    {
        return view('backend.user.deactivated');
    }

    public function mark(User $user,$status,ManageUserRequest $request)
    {
        $this->users->mark($user,$status);
        return redirect()->route($status == 1 ? "admin.user.index" : "admin.user.deactivated")->withFlashSuccess('用户状态修改成功!');
    }

    public function getDeleted(ManageUserRequest $request)
    {
        return view('backend.user.deleted');
    }

    public function restore(User $deletedUser, ManageUserRequest $request)
    {
        $this->users->restore($deletedUser);
        return redirect()->route('admin.user.deleted')->withFlashSuccess('用户恢复成功!');
    }

    public function delete(User $deletedUser,ManageUserRequest $request)
    {
        $this->users->forceDelete($deletedUser);
        return redirect()->route('admin.user.deleted')->withFlashSuccess('用户删除成功!');
    }


}
