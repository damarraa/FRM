<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
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

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
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

    /**
     * Show the form for editing the specified resource.
     */
    public function editProfile(): View
    {
        $user = auth()->user();

        $profilePicturePath = public_path('profile_pictures/' . $user->profile_picture);
        $profilePictureUrl = ($user->profile_picture && file_exists($profilePicturePath))
            ? asset('profile_pictures/' . $user->profile_picture)
            : asset('icons/user.png');

        return view('profile.edit_profile', compact('user', 'profilePictureUrl'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateProfile(Request $request)
    {
        // $user = User::findOrFail($id);
        $user = auth()->user();

        $request->validate([
            'alamat' => 'nullable|string|max:255',
            'no_hp' => 'required|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'signature' => 'nullable|string',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Tambahkan validasi untuk gambar
        ]);

        $data = $request->only(['alamat', 'no_hp']);

        // Handle password update jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Handle signature update
        if ($request->filled('signature')) {
            $signatureData = $request->input('signature');

            // Validasi bahwa signature adalah base64 image
            if (strpos($signatureData, 'data:image/png;base64,') === 0) {
                // Simpan sebagai data URL langsung atau konversi ke path file
                $data['signature'] = $signatureData;

                // Opsi alternatif: Simpan sebagai file
                /*
                $image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $signatureData));
                $filename = 'signature_' . $user->id . '_' . time() . '.png';
                Storage::disk('public')->put('signatures/'.$filename, $image);
                $data['signature'] = 'storage/signatures/'.$filename;
                */
            }
        }

        // Handle profile picture upload (revisi)
        if ($request->hasFile('profile_picture')) {
            // Hapus gambar lama jika ada
            if ($user->profile_picture) {
                $oldImagePath = public_path('profile_pictures/' . $user->profile_picture);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }

            $file = $request->file('profile_picture');
            $filename = 'user_' . $user->id . '_' . time() . '.jpg'; // Format: user_[id]_[timestamp].jpg
            $destinationFolder = public_path('profile_pictures');

            // Cek dan buat folder jika tidak ada
            if (!File::exists($destinationFolder)) {
                File::makeDirectory($destinationFolder, 0777, true, true);
            }

            $destinationPath = "{$destinationFolder}/{$filename}";

            // Proses gambar sesuai format asli
            $imageType = $file->getClientOriginalExtension();
            $image = null;

            switch ($imageType) {
                case 'jpg':
                case 'jpeg':
                    $image = imagecreatefromjpeg($file->getRealPath());
                    break;
                case 'png':
                    $image = imagecreatefrompng($file->getRealPath());
                    // Tambahkan background putih untuk PNG transparan
                    $whiteBackground = imagecreatetruecolor(imagesx($image), imagesy($image));
                    imagefill($whiteBackground, 0, 0, imagecolorallocate($whiteBackground, 255, 255, 255));
                    imagecopy($whiteBackground, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
                    $image = $whiteBackground;
                    break;
                case 'webp':
                    $image = imagecreatefromwebp($file->getRealPath());
                    break;
                default:
                    return redirect()->back()->with('error', 'Format gambar tidak didukung');
            }

            if ($image) {
                // Resize gambar (500x500 px)
                $width = imagesx($image);
                $height = imagesy($image);
                $newWidth = 500;
                $newHeight = ($newWidth / $width) * $height;

                $resizedImage = imagecreatetruecolor($newWidth, $newHeight);

                // Untuk PNG transparan
                if ($imageType === 'png') {
                    imagefill($resizedImage, 0, 0, imagecolorallocate($resizedImage, 255, 255, 255));
                }

                imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

                // Simpan sebagai JPG dengan kualitas 80%
                imagejpeg($resizedImage, $destinationPath, 80);

                // Bersihkan memory
                imagedestroy($image);
                imagedestroy($resizedImage);

                $data['profile_picture'] = $filename; // Simpan hanya nama file
            }
        }

        // Handle profile picture upload
        // if ($request->hasFile('profile_picture')) {
        //     // Hapus gambar lama jika ada
        //     if ($user->profile_picture) {
        //         Storage::delete('public/profile_pictures/' . $user->profile_picture);
        //     }

        //     // Simpan gambar baru
        //     $image = $request->file('profile_picture');
        //     $imageName = time() . '_' . $user->id . '.' . $image->getClientOriginalExtension();
        //     $image->storeAs('public/profile_pictures', $imageName);
        //     $data['profile_picture'] = $imageName;
        // }

        $user->update($data);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }
}
