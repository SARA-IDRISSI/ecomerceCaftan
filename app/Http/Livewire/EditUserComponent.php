<?php

namespace App\Http\Livewire;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditUserComponent extends Component
{
    use WithFileUploads;
    public $username, $email, $password, $showImage, $image, $newsletter, $validationMessage, $validationMessageError;

    public function mount()
    {
        $this->username = Auth::user()->username;
        $this->email = Auth::user()->email;
        $this->password = "";
        $this->showImage = Auth::user()->image;
        $this->newsletter = Auth::user()->newsletter;
    }

    public function post()
    {
        $image = Auth::user()->image;
        if ($this->image) {
            $image = "storage/" . $this->image->store("users/images");
        }
        try {
            User::where("id", Auth::user()->id)->update([
                "username" => $this->username,
                "email" => $this->email,
                "password" => $this->password ? Hash::make($this->password) : Auth::user()->password,
                "image" => $image,
                "newsletter" => $this->newsletter
            ]);
            $this->validationMessage = "Profile mis à jour ";
            $this->validationMessageError = "";
        } catch (Exception $e) {
            $this->validationMessageError = "Profile no mis à jour! " . $e->getMessage();
            $this->validationMessage = "";
        }
    }
    public function render()
    {
        return view('livewire.edit-user-component');
    }
}
