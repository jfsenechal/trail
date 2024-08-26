<?php

namespace App\Filament\Pages\Auth;

use App\Models\Role;
use Filament\Forms\Form;
use Filament\Pages\Auth\Register as BaseRegister;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Register extends BaseRegister
{
    public function beforeRegister()
    {
        //   $this->data['password'] = Hash::make('xxx');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                //  $this->getPasswordFormComponent(),
                //  $this->getPasswordConfirmationFormComponent(),
            ]);
    }

    protected function mutateFormDataBeforeRegister(array $data): array
    {
        $data['password'] = Hash::make(Str::password(length: 16));
        $data['roles'] = json_encode([Role::ROLE_JOGGER]);

        return $data;
    }
}
