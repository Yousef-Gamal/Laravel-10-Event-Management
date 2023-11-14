<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        return parent::toArray($request);
        return [
            'Id' => $this->id,
            'Name' => $this->name,
            'Description' => $this->description,
            'Start time' => $this->start_time,
            'End time' => $this->end_time,
            'User' => new UserResource($this->whenLoaded('user')),
            'Attendee' => new AttendeeResource($this->whenLoaded('Attendee'))
        ];
    }
}
