<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function toggleAdmin(User $user)
    {
        if (Auth::id() === $user->id) {
            return redirect()->route('admin.users.index')->with('error', 'Bạn không thể tự gỡ quyền admin của chính mình.');
        }

        $isDemoting = (bool) $user->is_admin;
        if ($isDemoting) {
            $adminCount = User::query()->where('is_admin', true)->count();
            if ($adminCount <= 1) {
                return redirect()->route('admin.users.index')->with('error', 'Không thể gỡ quyền admin của admin cuối cùng.');
            }
        }

        $user->is_admin = ! $user->is_admin;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Đã cập nhật quyền admin.');
    }
}

