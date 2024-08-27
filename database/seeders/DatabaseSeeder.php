<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Trail;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    protected static ?string $password;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = Role::factory()->create([
            'name' => Role::ROLE_ADMIN,
        ]);
        $jogger = Role::factory()->create([
            'name' => Role::ROLE_JOGGER,
        ]);
        User::factory()
            ->hasAttached($admin)
            ->hasAttached($jogger)
            ->create([
                'name' => 'Test User',
                'first_name' => 'Jf',
                'last_name' => 'Sénéchal',
                'email' => 'jf@marche.be',
                'password' => static::$password ??= Hash::make('homer'),
            ]);
        Trail::factory()->create([
            'name' => 'Trail 100Km',
            'location' => 'Marche-en-Famenne',
            'date_occurred' => new \DateTime(),
        ]);
    }
}
