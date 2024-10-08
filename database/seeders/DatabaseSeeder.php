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
        $adminRole = Role::factory()->create([
            'name' => Role::ROLE_ADMIN,
        ]);
        $runnerRole = Role::factory()->create([
            'name' => Role::ROLE_RUNNER,
        ]);
        $user = User::factory()
            ->hasAttached($adminRole)
            ->hasAttached($runnerRole)
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

        $user->createToken(config('app.name'));
        // Create additional users
        //User::factory(10)->create();
        // Create Leads
        /*   Lead::factory(100)->create()->each(function ($lead) {
               if ($lead->status == LeadStatus::Qualified) {
                   // Create Deal for this lead
                   $deal = Deal::create([
                       'title' => $lead->title,
                       'customer_id' => $lead->customer_id,
                       'lead_id' => $lead->id,
                       'estimated_revenue' => $lead->estimated_revenue,
                       'status' => rand(1, 3),
                       'description' => $lead->description,
                       'created_at' => $lead->created_at,
                   ]);

                   // Add products to deal
                   DealProduct::factory(rand(1, 5))->create([
                       'deal_id' => $deal->id,
                   ]);
               }
           });*/
    }
}
