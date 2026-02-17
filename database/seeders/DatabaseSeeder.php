<?php

namespace Database\Seeders;

use App\Enums\HouseholdRole;
use App\Enums\MembershipStatus;
use App\Models\Household;
use App\Models\HouseholdMembership;
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
        $users = User::factory(10)->create([
            'password' => Hash::make('password'),
        ]);

        $households = Household::factory(3)->create();

        foreach ($households as $household) {
            $owner = $users->random();

            HouseholdMembership::create([
                'household_id' => $household->id,
                'user_id' => $owner->id,
                'role' => HouseholdRole::OWNER->label(),
                'status' => MembershipStatus::ACTIVE->label(),
            ]);

            $members = $users->where('id', '!=', $owner->id)->random(rand(2, 4));

            foreach ($members as $member) {
                HouseholdMembership::create([
                    'household_id' => $household->id,
                    'user_id' => $member->id,
                    'role' => HouseholdRole::MEMBER->label(),
                    'status' => MembershipStatus::ACTIVE->label(),
                ]);
            }
        }

        $rooms = Room::factory(20)->make();

        foreach ($rooms as $room) {
            $room->household_id = $households->random()->id;
            $room->save();
        }

        $tasks = Task::factory(100)->make();

        foreach ($tasks as $task) {
            $room = $rooms->random();
            $task->room_id = $room->id;
            $task->save();
        }
    }
}
