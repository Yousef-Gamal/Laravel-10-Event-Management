<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendeeResource;
use App\Http\Traits\CanLoadRelationships;
use App\Models\{Event, Attendee};
use Illuminate\Http\Request;

class AtendeeController extends Controller
{
    use CanLoadRelationships;
    private array $relations = ['user'];
    public function index(Event $event)
    {
        $attendees = $this->LoadRelationships(
            $event->attendees()->latest()
        );

        return AttendeeResource::collection(
            $attendees->paginate()
        );
    }

    public function store(Request $request,Event $event)
    {
        $attendee = $this->LoadRelationships(
            $event->attendees()->create([
                'user_id' => 1
            ])
        );
        return new AttendeeResource($attendee);
    }

    public function show(Event $event,Attendee $attendee)
    {
        return new AttendeeResource($this->LoadRelationships($attendee));
    }

    public function destroy(string $event,Attendee $attendee)
    {
        $attendee->delete();

        return response(status: 204);
    }
}
