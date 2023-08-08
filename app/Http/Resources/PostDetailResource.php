<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostDetailResource extends JsonResource
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
            'author' => $this->author,
            'created_at' => date( 'Y-m-d H:i:s',strtotime( $this->created_at)),
            'writer' => $this->whenLoaded('writer'),
            'comments'=> $this->whenLoaded('comments', function (){
                return collect($this->comments)->each(function($comment){
                    $comment->commentator;
                    return ($comment);
                });
            }),
            'total_comment' => $this->whenLoaded('comments',function (){
                return $this->comments->count()  ;
            })

        ] ;
    }
}
