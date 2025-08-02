<?php declare(strict_types=1);

namespace App\Http\Controllers\Assistant;

use App\Models\User;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::with('roles')->paginate(15);
        return view('assistant.users.index', compact('users'));
    }

    public function show(User $user): View
    {
        $user->load('roles', 'permissions');
        return view('assistant.users.show', compact('user'));
    }
}
