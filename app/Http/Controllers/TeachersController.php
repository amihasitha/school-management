<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class TeachersController extends Controller
{
    /**
     * Ensure only Super Admin can manage teachers.
     */
    private function authorizeSuperAdmin(): void
    {
        abort_unless(
            auth()->check() &&
            auth()->user()->user_type === 'super_admin',
            403
        );
    }

    /**
     * Display registered teachers with search and filters.
     */
    public function index(Request $request): View
    {
        $this->authorizeSuperAdmin();

        $query = User::select(
            'id',
            'user_type',
            'name',
            'email',
            'nic',
            'index_number',
            'created_at'
        )->where('user_type', 'teacher');

        // Search by name, email, or NIC.
        if ($request->filled('search')) {
            $search = $request->input('search');

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('nic', 'like', "%{$search}%");
            });
        }

        // Filter by email availability.
        if ($request->input('email_status') === 'with_email') {
            $query->whereNotNull('email')
                ->where('email', '!=', '');
        } elseif ($request->input('email_status') === 'without_email') {
            $query->where(function ($q) {
                $q->whereNull('email')
                    ->orWhere('email', '');
            });
        }

        $users = $query->latest()
            ->paginate(15)
            ->withQueryString();

        return view('teachers.index', compact('users'));
    }

    /**
     * Display the teacher edit form.
     */
    public function edit(User $user): View
    {
        $this->authorizeSuperAdmin();

        abort_unless($user->user_type === 'teacher', 404);

        return view('teachers.edit', compact('user'));
    }

    /**
     * Update a teacher's details.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $this->authorizeSuperAdmin();

        abort_unless($user->user_type === 'teacher', 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],

            'nic' => ['required', 'string', 'max:50'],
        ]);

        // Normalize an empty email field to NULL.
        $validated['email'] = $validated['email'] ?? null;

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->nic = $validated['nic'];
        $user->save();

        return redirect()
            ->route('teachers.index')
            ->with('success', 'Teacher details updated successfully.');
    }

    public function destroy(User $user): \Illuminate\Http\RedirectResponse
    {
        // Only Super Admin can delete teacher accounts.
        abort_unless(
            auth()->check() &&
            auth()->user()->user_type === 'super_admin',
            403
        );

        // Prevent deleting non-teacher accounts.
        abort_unless($user->user_type === 'teacher', 404);

        $user->delete();

        return redirect()
            ->route('teachers.index')
            ->with('success', 'Teacher account deleted successfully.');
    }

    // Display the Add Teacher form
    public function create()
    {
        abort_unless(
            auth()->user()->user_type === 'super_admin',
            403
        );

        return view('teachers.create');
    }

    // Save a new teacher
    public function store(Request $request)
    {
        abort_unless(
            auth()->user()->user_type === 'super_admin',
            403
        );

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nic' => ['required', 'string', 'max:20', 'unique:users,nic'],
            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('users', 'email'),
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $validated['name'],
            'user_type' => 'teacher',
            'nic' => $validated['nic'],
            'email' => filled($validated['email'] ?? null)
                ? $validated['email']
                : null,
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()
            ->route('teachers.index')
            ->with('success', 'Teacher account created successfully.');
    }
}
