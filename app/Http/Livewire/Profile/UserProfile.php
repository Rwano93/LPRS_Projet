<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Component;

class UserProfile extends Component
{
    use WithFileUploads;

    public User $user;
    public $photo;
    public $cv;

    public $state = [];

    protected $rules = [
        'state.nom' => 'required',
        'state.prenom' => 'required',
        'state.email' => 'required|email',
    ];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->state = $user->toArray();
    }

    public function updateProfileInformation()
    {
        $this->resetErrorBag();

        $this->user->forceFill([
            'nom' => $this->state['nom'],
            'prenom' => $this->state['prenom'],
            'email' => $this->state['email'],
        ])->save();

        if ($this->photo) {
            $this->user->updateProfilePhoto($this->photo);
        }

        if ($this->cv) {
            $this->user->updateCV($this->cv);
        }

        $this->emit('saved');
        $this->emit('refresh-navigation-menu');
    }


    public function deleteCV()
    {
        if ($this->user->cv) {
            Storage::disk('public')->delete($this->user->cv);
            $this->user->forceFill([
                'cv' => null,
            ])->save();
        }
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}

