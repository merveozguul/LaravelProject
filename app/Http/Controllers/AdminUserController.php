<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class AdminUserController extends Controller
{
    // 1. Kullanıcıları Listeleme
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    // 2. Kullanıcı Detay ve Rol Yönetim Sayfası
    public function show($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::all(); // Seçim kutusunda göstermek için tüm roller
        return view('admin.users.show', compact('user', 'roles'));
    }

    // 3. Kullanıcıya Rol Ekleme (Attach)
    public function addRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $roleId = $request->input('role_id');

        // Eğer kullanıcıda bu rol zaten yoksa ekle (Çift kayıt engeli)
        if (!$user->roles->contains($roleId)) {
            $user->roles()->attach($roleId);
        }

        return back()->with('success', 'Role attached to user successfully.');
    }

    // 4. Kullanıcıdan Rol Silme (Detach)
    public function removeRole($userId, $roleId)
    {
        $user = User::findOrFail($userId);
        $user->roles()->detach($roleId); // İlişkiyi ara tablodan söker atar

        return back()->with('success', 'Role detached from user successfully.');
    }
}
