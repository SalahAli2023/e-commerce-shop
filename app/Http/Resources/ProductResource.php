<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'description' => $this->description,
            'price' => (float) $this->price,
            'discounted_price' => (float) $this->discounted_price,
            'on_sale' => (bool) $this->on_sale,
            'image_path' => $this->image_path ? asset('storage/' . $this->image_path) : null,
            'category' => new CategoryResource($this->whenLoaded('category')),
            'average_rating' => (float) $this->average_rating,
            'reviews_count' => (int) $this->reviews_count,
            'created_at' => $this->created_at->toISOString(),
            'updated_at' => $this->updated_at->toISOString(),
            'links' => [
                'self' => route('api.v1.products.show', $this->id),
                'category' => $this->category_id ? route('api.v1.categories.show', $this->category_id) : null,
            ]
        ];
    }
}