<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;


class ProfileController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function view()
    {
        $users = User::all();
        return view('user.view', compact('users'));
    }

    public function edit(Request $request): View
    {
        return view('user.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'user.index');
    }
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);
        $user = $request->user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function editById($id): View
    {
        $user = User::findOrFail($id);
        return view('user.editById', [
            'user' => $user,
        ]);
    }


    public function updateById(ProfileUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->fill($request->validated());
        
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        
    $user->save();

    if ($request->has('role') && in_array($request->role, [1, 2, 3])) {
        $user->role = $request->role;
        $user->save();
    }

        return Redirect::route('profile.index')->with('status', 'Profile updated successfully');
    }

    public function destroyById($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('profile.index')->with('status', 'Account deleted successfully.');
    }

    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:1,2,3',
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('user.index')->with('status', 'Role updated successfully.');
    }


    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,user',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = $request->role;
        $user->save();

        return redirect()->route('user.index')->with('success', 'User has been added successfully');
    }

    public function resetPassword($id)
    {
        $user = User::findOrFail($id);
        $user->password = Hash::make('admin1234');
        $user->save();
        return back()->with('success', 'Password berhasil direset menjadi admin1234');
    }
    
    function show(){
        
    }
}
