<?php

namespace Database\Seeders;

use App\Enums\HouseholdRole;
use App\Enums\MembershipStatus;
use App\Models\Household;
use App\Models\Room;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // dev seed
        $owner = User::factory()->state([
            'email' => 'test@user.de',
            'password' => Hash::make('password'),
        ])->create();

        Household::factory()
            ->state([
                'created_by' => $owner->id,
            ])
            ->hasAttached(
                $owner,
                fn () => [
                    'role' => HouseholdRole::OWNER->label(),
                    'status' => MembershipStatus::ACTIVE->label(),
                ]
            )
            ->hasAttached(
                User::factory(3),
                fn () => [
                    'role' => HouseholdRole::MEMBER->label(),
                    'status' => MembershipStatus::ACTIVE->label(),
                ]
            )
            ->has(
                Room::factory(5)
                    ->has(
                        Task::factory(30)
                    ),
                'rooms'
            )
            ->create();
    }
}
