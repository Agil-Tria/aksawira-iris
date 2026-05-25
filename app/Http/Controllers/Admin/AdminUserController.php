<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{


    public function index()
    {
        $users = User::latest()->paginate(10);

        return view(
            'admin.users.index',
            compact('users')
        );
    }

    public function approve(User $user)
    {
        $user->update([

            'status' => 'active'

        ]);

        return back()->with(
            'success',
            'User berhasil diapprove'
        );
    }
}
