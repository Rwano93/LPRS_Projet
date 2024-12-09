<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif', 'max:2048'],
            'cv' => ['nullable', 'file', 'mimes:pdf', 'max:5120'], // Allow PDF files up to 5MB
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            try {
                $user->updateProfilePhoto($input['photo']);
                Log::info('Profile photo updated successfully', [
                    'user_id' => $user->id,
                    'original_name' => $input['photo']->getClientOriginalName(),
                    'mime_type' => $input['photo']->getMimeType(),
                ]);
            } catch (\Exception $e) {
                Log::error('Error updating profile photo', [
                    'user_id' => $user->id,
                    'error' => $e->getMessage(),
                ]);
                throw $e;
            }
        }

        if (isset($input['cv'])) {
            $this->updateCV($user, $input['cv']);
        }

        if (isset($input['delete_cv']) && $input['delete_cv'] === true) {
            $this->deleteCV($user);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'nom' => $input['nom'],
                'prenom' => $input['prenom'],
                'email' => $input['email'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'nom' => $input['nom'],
            'prenom' => $input['prenom'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }

    /**
     * Update the user's CV.
     *
     * @param  mixed  $user
     * @param  \Illuminate\Http\UploadedFile  $cv
     * @return void
     */
    protected function updateCV($user, $cv)
    {
        $path = $cv->store('cvs', 'public');

        if ($user->cv) {
            Storage::disk('public')->delete($user->cv);
        }

        $user->forceFill([
            'cv' => $path,
        ])->save();

        Log::info('CV updated successfully', [
            'user_id' => $user->id,
            'cv_path' => $path,
        ]);
    }

    /**
     * Delete the user's CV.
     *
     * @param  mixed  $user
     * @return void
     */
    protected function deleteCV($user)
    {
        if ($user->cv) {
            Storage::disk('public')->delete($user->cv);
            
            $user->forceFill([
                'cv' => null,
            ])->save();

            Log::info('CV deleted successfully', [
                'user_id' => $user->id,
            ]);
        }
    }
}

