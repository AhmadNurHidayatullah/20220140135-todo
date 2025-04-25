<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $search = request('search');

        if ($search) {
            $users = User::where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%') // Perbaikan di sini
                      ->orWhere('email', 'like', '%' . $search . '%'); // Perbaikan di sini
            })
            ->orderBy('name')
            ->where('id', '!=', 1)
            ->paginate(20)
            ->withQueryString();
        } else {
            $users = User::where('id', '!=', 1)
            ->orderBy('name')
            ->paginate(10);
        }

        return view('user.index', compact('users'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User  deleted successfully!');
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

}
