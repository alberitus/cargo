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
    /**
     * Display the user's profile form.
     */

     public function index()
    {
        $users = User::all();  // Fetch all users
        return view('user.index', compact('users'));
    }

    public function edit(Request $request): View
    {
        return view('user.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'user.index');
    }

    /**
     * Delete the user's account.
     */
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
        $user = User::findOrFail($id); // Menarik data berdasarkan ID
        return view('user.index', [
            'user' => $user,
        ]);
    }

    /**
     * Update a specific user's profile information by ID.
     */
    public function updateById(ProfileUpdateRequest $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id); // Menarik data berdasarkan ID
        $user->fill($request->validated());

        // Jika email diubah, setel ulang status verifikasi email
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.editById', ['id' => $user->id])->with('status', 'Profile updated successfully');
    }

    /**
     * Delete a specific user's account by ID.
     */
    public function destroyById(Request $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,user',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Menyimpan user baru
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // Hash password
        $user->role = $request->role;
        $user->save();

        // Redirect atau beri pesan sukses
        return redirect()->route('user.index')->with('success', 'User has been added successfully');
    }
}
