<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->resource['id'],
            'email' => $this->resource['email'],
            'name' => $this->resource['name'],
            'surname' => $this->resource['surname'],
            'birthday' => $this->resource['birthday'],
            'createdAt' => $this->resource['createdAt'],
            'updatedAt' => $this->resource['updatedAt']
        ];
    }
}
