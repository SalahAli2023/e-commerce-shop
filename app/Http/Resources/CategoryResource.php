<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'slug' => $this->slug,
            'products_count' => (int) $this->whenCounted('products'),
            'created_at' => $this->created_at->toISOString(),
            'updated_at' => $this->updated_at->toISOString(),
            'products' => ProductResource::collection($this->whenLoaded('products')),
            'links' => [
                'self' => route('api.v1.categories.show', $this->id),
                'products' => route('api.v1.products.index', ['category' => $this->id]),
            ]
        ];
    }
}