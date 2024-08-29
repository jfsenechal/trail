<?php

namespace App\Filament\Pages\Auth;

use App\Mail\RegistrationCompleted;
use App\Models\User;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Register as BaseRegister;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class Register extends BaseRegister
{
    private function testMail()
    {
        $user = User::all()->first();
        $token = $user->createToken(config('app.name'));
        Mail::to($user->email)->send(new RegistrationCompleted($user, $token));
    }

    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this
                    ->makeForm()
                    ->columns(2)
                    ->schema([
                        $this->getFirstNameFormComponent(),
                        $this->getLastNameFormComponent(),
                        //$this->getNameFormComponent(),
                        $this->getEmailFormComponent(),
                        //$this->getPasswordFormComponent(),
                        //$this->getPasswordConfirmationFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function mutateFormDataBeforeRegister(array $data): array
    {
        $data['password'] = Hash::make(Str::password(length: 16));
        $data['name'] = $data['first_name'];

        return $data;
    }

    protected function getFirstNameFormComponent(): Component
    {
        return TextInput::make('first_name')
            ->label(__('messages.register.form.first_name.label'))
            ->required()
            ->maxLength(120);
    }

    protected function getLastNameFormComponent(): Component
    {
        return TextInput::make('last_name')
            ->label(__('messages.register.form.last_name.label'))
            ->required()
            ->maxLength(120);
    }
}
