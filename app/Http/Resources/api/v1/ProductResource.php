<?php

namespace App\Http\Resources\api\v1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
        /*return [
            'data' => $this->collection,
            'links' => [
                'self' => 'link-value',
            ],
        ];*/

        /*$this->collection->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'description' => $item->description
            ];
        });*/
    }

    public function with(Request $request){
        return [
            'message'=>$request->input('message')
        ];
    }
}
