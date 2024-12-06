<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class UpdateProfileInformationForm extends Component
{
    use WithFileUploads;

    public $state = [];
    public $photo;
    public $cv;
    public $cvName;

    protected $listeners = ['refresh-navigation-menu' => '$refresh'];

    public function mount()
    {
        $this->state = Auth::user()->withoutRelations()->toArray();
        $this->cvName = basename(Auth::user()->cv ?? '');
    }

    public function updateProfileInformation(UpdatesUserProfileInformation $updater)
    {
        $this->resetErrorBag();

        $this->validate([
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:2048'],
            'cv' => ['nullable', 'file', 'mimes:pdf', 'max:2048'],
            'state.nom' => ['required', 'string', 'max:255'],
            'state.prenom' => ['required', 'string', 'max:255'],
            'state.email' => ['required', 'email', 'max:255'],
        ]);

        if (isset($this->photo)) {
            $this->state['photo'] = $this->photo;
        }

        if ($this->cv) {
            $cvPath = $this->cv->store('cvs', 'public');
            $this->state['cv'] = $cvPath;
            Log::info('CV file uploaded in Livewire', ['cv_path' => $cvPath]);
        }

        $updater->update(Auth::user(), $this->state);

        if ($this->cv) {
            $this->cvName = basename(Auth::user()->cv);
        }

        $this->emit('saved');
        $this->emit('refresh-navigation-menu');
    }

    public function deleteProfilePhoto()
    {
        Auth::user()->deleteProfilePhoto();
        $this->emit('refresh-navigation-menu');
    }

    public function deleteCV()
    {
        $user = Auth::user();
        if ($user->cv) {
            Storage::disk('public')->delete($user->cv);
            $user->cv = null;
            $user->save();
            $this->cvName = null;
            $this->cv = null;
            Log::info('CV deleted', ['user_id' => $user->id]);
        }
    }

    public function getUserProperty()
    {
        return Auth::user();
    }

    public function render()
    {
        return view('profile.update-profile-information-form');
    }
}

