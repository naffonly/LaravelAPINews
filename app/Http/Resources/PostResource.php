<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return 
        [
            'id' => $this->id,
            'tittle' => $this->tittle,
            'news_content'=> $this->news_content,
            'create_at' => date( 'Y-m-d H:i:s',strtotime( $this->created_at))
        ];
    }
}
