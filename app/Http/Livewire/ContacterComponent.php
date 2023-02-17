<?php

namespace App\Http\Livewire;

use App\Mail\ContactConfirmation;
use App\Mail\ContactForm;
use Exception;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContacterComponent extends Component
{
    public $name, $email, $number, $contenu, $validationMessage, $loading;

    public function mount()
    {
        $this->name = "";
        $this->email = "";
        $this->number = "";
        $this->validationMessage = "";
        $this->contenu = "";
        $this->loading = false;
    }

    public function post()
    {
        $this->loading = true;
        if ($this->contenu != "" && $this->name != "" && $this->email != "") {
            try {
                Mail::to(env("MAIL_FROM_ADDRESS"))->send(new ContactForm($this->name, $this->email, $this->number, $this->contenu));
                Mail::to($this->email)->send(new ContactConfirmation($this->name));
                $this->validationMessage = "Email envoyé avec succès";
            } catch (Exception $e) {
                $this->validationMessage = "Email non envoyé!";
            }
        } else {
            $this->validationMessage = "Tous les champs ne sont pas remplis!";
        }
        $this->loading = false;
    }
    public function render()
    {
        return view('livewire.contacter-component')->layout("layouts.base");
    }
}
