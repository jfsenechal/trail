<?php

namespace App\Filament\Pages\Auth;

use App\Models\Role;
use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EditProfile extends BaseEditProfile
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getFirstNameFormComponent(),
                $this->getLastNameFormComponent(),
                // $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                // $this->getPasswordFormComponent(),
                //  $this->getPasswordConfirmationFormComponent(),
            ]);
    }

    protected function mutateFormDataBeforeRegister(array $data): array
    {
        $data['password'] = Hash::make(Str::password(length: 16));
        $data['roles'] = json_encode([Role::ROLE_JOGGER]);
        $data['name'] = $data['first_name'];

        return $data;
    }

    protected function getFirstNameFormComponent(): Component
    {
        return TextInput::make('first_name')
            ->label(__('register.form.first_name.label'))
            ->required()
            ->maxLength(120);
    }

    protected function getLastNameFormComponent(): Component
    {
        return TextInput::make('last_name')
            ->label(__('register.form.last_name.label'))
            ->required()
            ->maxLength(120);
    }
}
