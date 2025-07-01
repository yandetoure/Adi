<?php declare(strict_types=1);

namespace App\Http\Controllers\Assistant;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $users = User::withCount('orders')->latest()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user): View
    {
        $user->load(['orders' => function ($query) {
            $query->latest()->limit(10);
        }]);
        
        return view('admin.users.show', compact('user'));
    }
}
