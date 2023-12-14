<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Bidang;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $bidangs = Bidang::all(); // Mengambil semua bidang
        return view('profile.edit', [
            'user' => $request->user(),
            'bidangs' => $bidangs,
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Mengisi model User dengan data dari request
        $user->fill($request->validated());

        // Jika ada pembaruan pada foto
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto) {
                Storage::delete($user->foto);
            }

            // Simpan foto baru dan dapatkan path-nya
            $fotoPath = $request->file('foto')->store('user_fotos', 'public');

            // Simpan path foto ke dalam model User
            $user->foto = $fotoPath;
        }

        // Menyimpan perubahan pada model User ke database
        $user->save();

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
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
}
