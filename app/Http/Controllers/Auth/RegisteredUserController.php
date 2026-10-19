<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register', [
            'canRegisterSuperAdmin' => !$this->superAdminExists(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        // Public sign-up must never let anyone become Super Admin once one exists.
        $allowedTypes = ['teacher', 'student'];
        if (!$this->superAdminExists()) {
            $allowedTypes[] = 'super_admin';
        }

        $request->validate([
            'user_type' => ['required', Rule::in($allowedTypes)],
            'name' => ['required', 'string', 'max:255'],            
            'email' => ['required_if:user_type,super_admin', 'nullable', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'nic' => ['required_if:user_type,teacher', 'nullable', 'string', 'max:12', 'unique:users,nic'],
            'index_number' => ['required_if:user_type,student', 'nullable', 'string', 'max:10', 'unique:users,index_number'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $type = $request->user_type;

        $user = User::create([
            'user_type' => $type,
            'name' => $request->name,
            'email' => $request->filled('email') ? $request->email : null,
            'nic' => $type === 'teacher' ? $request->nic : null,
            'index_number' => $type === 'student' ? $request->index_number : null,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    private function superAdminExists(): bool
    {
        return User::where('user_type', 'super_admin')->exists();
    }
}