<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'membership_level' => ['required', 'string', 'max:50'],
            'points' => ['required', 'integer', 'min:0'],
        ]);

        $user->update($data);

        return redirect()->route('admin.users.show', $user)->with('success', 'Đã cập nhật thông tin thành viên.');
    }
}

