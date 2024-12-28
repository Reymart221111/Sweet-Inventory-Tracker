<?php

namespace App\Livewire\AccountSettings;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\{Auth, Storage, Log};
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AccountProfile extends Component
{
    use WithFileUploads;

    public $profile_image;
    private $rolePrefix;

    protected function rules(): array
    {
        return [
            'profile_image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }

    public function updatedProfileImage()
    {
        $this->validateOnly('profile_image');
    }

    public function updateProfileImage()
    {
        $this->validate();

        try {
            $user = Auth::user();
            $oldImagePath = $user->profile_path;

            if (!$this->profile_image) {
                session()->flash('error', 'No image file uploaded.');
                return;
            }

            $manager = new ImageManager(new Driver());
            $image = $manager->read($this->profile_image->getRealPath());

            $image->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $role = strtolower($user->role);
            $path = "uploads/profile-images/{$role}/";

            Storage::disk('public')->makeDirectory($path);

            $filename = sprintf(
                'profile-%s-%s.%s',
                $user->id,
                time(),
                $this->profile_image->getClientOriginalExtension()
            );

            $imagePath = $path . $filename;
            Storage::disk('public')->put($imagePath, (string) $image->encode());

            $this->updateUserProfileImage($user, $imagePath, $oldImagePath);

            $this->reset('profile_image');

            $this->checkRolePrefix();

            return redirect()->route($this->rolePrefix . '.accounts.profile')->with('success', 'Profile Image Uploaded Succesfully');
        } catch (\Exception $e) {
            $this->handleImageUploadError($e, $imagePath ?? null);
        }
    }

    private function checkRolePrefix()
    {
        $this->rolePrefix = '';
        if (Auth::user()->role === 'admin') {
            $this->rolePrefix = 'admin';
        } elseif (Auth::user()->role === 'manager') {
            $this->rolePrefix = 'manager';
        } elseif (Auth::user()->role === 'employee') {
            $this->rolePrefix = 'employee';
        }

        return $this->rolePrefix;
    }

    private function updateUserProfileImage($user, string $newImagePath, ?string $oldImagePath)
    {
        $user->profile_path = $newImagePath;
        $user->save();

        if ($oldImagePath && Storage::disk('public')->exists($oldImagePath)) {
            Storage::disk('public')->delete($oldImagePath);
        }
    }

    private function handleImageUploadError(\Exception $e, ?string $imagePath)
    {
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        Log::error('Profile Image Upload Error: ' . $e->getMessage());
        session()->flash('error', 'An error occurred while updating your profile image.');
    }

    public function render()
    {
        return view('livewire.account-settings.account-profile', [
            'user' => Auth::user(),
        ]);
    }
}
