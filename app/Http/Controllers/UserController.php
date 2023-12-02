<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Response;
use Inertia\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller {
    use ImageValidationRules;

    public function index(): Response|ResponseFactory {
        return inertia('Admin/Users', [
            'users' => User::all()->map(function ($user) {
                return [
                    'id'    => $user->id,
                    'name'  => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'role'  => $user->role,
                ];
            }),
            'roles' => ['admin', 'user'],
        ]);
    }

    // меняет роли
    public function store(Request $request): RedirectResponse {
        $request->validate([
            'id'   => ['int','required'],
            'role' => ['string', 'required'],
        ]);

        $input = $request->input();
        $role = $input['role'];

        if ($role !== 'admin' && $role !== 'user') {
            abort(404);
        }

        $user = User::findOrFail($input['id']);
        $user->role = $role;
        $user->save();

        return to_route('admin.users')->with('success', 'Роль изменена');
    }

    public function destroy(int $id): RedirectResponse {
        $user = User::findOrFail($id);

        $user->deleteProfilePhoto();
        $user->tokens->each->delete();
        $user->delete();

        return to_route('admin.users')->with('success', 'Пользователь удален!');
    }
}
