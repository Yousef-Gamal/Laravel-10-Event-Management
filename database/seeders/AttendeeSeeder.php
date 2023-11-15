<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = \App\Models\User::all();
        $events = \App\Models\Event::all();

        foreach($users as $user){
            $eventToAttendee = $users->random(rand(1,3));
            foreach($eventToAttendee as $event){
                \App\Models\Attendee::factory()->create([
                    'user_id' => $user->id,
                    'event_id' => $event->id
                ]);
            }
        }
    }
}
