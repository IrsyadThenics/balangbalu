<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function home()
    {
        $reports = Report::latest()->get();
        return view('admin.home', compact('reports'));
    }

    public function reports()
    {
        $reports = Report::latest()->get();
        return view('admin.report', compact('reports'));
    }

    public function history()
    {
        $reports = Report::where('user_id', Auth::id())->latest()->get();
        return view('admin.history', compact('reports'));
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->save();

        return redirect()->back()->with('success', 'Profil admin berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $user = User::find(Auth::id());
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->back()->with('success', 'Kata sandi admin berhasil diperbarui.');
    }
}
