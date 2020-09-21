<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Topicality extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // add some resources or modify the display of the topicality 
        return [
            'id' => 'Id de la topicality : ' . $this->id,
            'title' => 'Titre de mon actualité : ' . $this->title,
            'content' => substr($this->content, 0, 20) . '...',
            'user_id' => "Id du user : " . $this->user_id,
        ];
    }
}
