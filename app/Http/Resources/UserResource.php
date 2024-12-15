<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'created_by' =>$this->createdBy ? $this->createdBy->name : "null",
            'updated_by' =>$this->updatedBy ? $this->updatedBy->name : "null",
            'age' => $this->detailes ? $this->detailes->age : "null",
            'gender' => $this->detailes ? $this->detailes->gender : "null",
            'phone' => $this->detailes ? $this->detailes->phone : "null",
            'address' => $this->detailes ? $this->detailes->address : "null",
            'role' => $this->roles,

        ];
    }
}
