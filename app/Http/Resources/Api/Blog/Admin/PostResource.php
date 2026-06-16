<?php

namespace App\Http\Resources\Api\Blog\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;

class PostResource extends JsonResource
{
    /**
     * Трансформація ресурсу в масив.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'title'          => $this->title,
            'slug'           => $this->slug,
            'is_published'   => (bool) $this->is_published,

            // БЕЗПЕЧНЕ ФОРМАТУВАННЯ: перетворюємо рядок на дату перед викликом format()
            'date_published' => $this->published_at ? Carbon::parse($this->published_at)->format('Y-m-d H:i:s') : null,

            'user_id'        => $this->user_id,
            'category_id'    => $this->category_id,
        ];
    }
}
