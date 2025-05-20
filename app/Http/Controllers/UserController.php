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
            $users = User::with('todos')->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%') // Perbaikan di sini
                      ->orWhere('email', 'like', '%' . $search . '%'); // Perbaikan di sini
            })
            ->orderBy('name')
            ->where('id', '!=', 1)
            ->simplePaginate(20)
            ->withQueryString();
        } else {
            $users = User::with('todos')->where('id', '!=', 1)
            ->orderBy('name')
            ->simplePaginate(10);
        }

        return view('user.index', compact('users'));
    }

    public function destroy(User $user)
    {
        if ($user->id != 1) {
            $user->delete();
            return back()->with('success', 'User deleted successfully!');
        } else {
            return redirect()->route('user.index')->with('danger', 'Cannot delete this user!');
        }
    }

    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }


    public function makeadmin(User $user)
    {
        if ($user->id != 1) {
            $user->is_admin = true;
            $user->save();

            return back()->with('success', 'Make admin successfully!');
        }

        return redirect()->route('user.index');
    }

    public function removeadmin(User $user)
    {
        if ($user->id != 1) {
            $user->is_admin = false;
            $user->save();

            return back()->with('success', 'Remove admin successfully!');
        }

        return redirect()->route('user.index');
    }





}
