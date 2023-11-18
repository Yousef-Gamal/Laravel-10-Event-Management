<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendeeResource;
use App\Http\Traits\CanLoadRelationships;
use App\Models\{Event, Attendee, User};
use Illuminate\Http\Request;

class AtendeeController extends Controller
{
    use CanLoadRelationships;
    private array $relations = ['user'];

    public function __Construct(){
        $this->middleware('auth:sanctum')->except(['index','show','update']);
        $this->authorizeResource(Attendee::class,'attendee');
    }
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
                'user_id' => $request->user()->id
            ])
        );
        return new AttendeeResource($attendee);
    }

    public function show(Event $event,Attendee $attendee)
    {
        return new AttendeeResource($this->LoadRelationships($attendee));
    }

    public function destroy(Event $event,Attendee $attendee)
    {
//        $this->authorize('delete-attendee',[$event,$attendee]); Now, we are using policies

        $attendee->delete();

        return response(status: 204);
    }
}
