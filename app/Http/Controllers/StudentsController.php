<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class StudentsController extends Controller
{
    public function index(): View
    {
        // Only Super Admin can view the users list
        abort_unless(
            auth()->user()->user_type === 'super_admin',
            403
        );

        $users = User::select(
            'id',
            'user_type',
            'name',
            'email',
            'nic',
            'index_number',
            'created_at'
        )
        ->where('user_type', 'student')
        ->latest()
        ->paginate(15);

        return view('students.index', compact('users'));
    }
}