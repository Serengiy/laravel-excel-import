<?php

namespace App\Http\Resources\Project;

use App\Http\Resources\Type\TypeResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
//        dd((new TypeResource($this->type))->title);
        return [
            'id' => $this->id,
            'type' => (new TypeResource($this->type))->title,
            'title' => $this->title,
            'contracted_at' => isset($this->contracted_at) ? $this->contracted_at->format('Y-m-d') : null,
            'created_at_time' => isset($this->created_at_time) ? $this->created_at_time->format('Y-m-d') : null,
            'deadline' => isset($this->deadline) ? $this->deadline->format('Y-m-d') : null,
            'is_on_time' => isset($this->is_on_time) ? $this->is_on_time ? 'Да' : 'Нет' : null,
            'has_outsource' => isset($this->has_outsource) ? $this->has_outsource ? 'Да' : 'Нет' : null,
            'has_investors' => isset($this->has_investors) ? $this->has_investors ? 'Да' : 'Нет' : null,
            'worker_count' => isset($this->worker_count) ?? null,
        ];
    }
}
