<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Exception
 */
class ExceptionResource extends JsonResource
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
            'id' => $this->id,
            'status' => strtolower($this->status),
            'project_id' => $this->project_id,
            'public_hash' => $this->publish_hash,
            'public_hash_url' => $this->publish_hash ? route('public.exception', $this->publish_hash) : null,
            'class' => $this->class,
            'error' => $this->error,
            'exception' => $this->exception,
            'line' => $this->line,
            'file' => $this->file,
            'url' => $this->fullUrl,
            'route_url' => $this->route_url,
            'executor' => $this->executor,
            'executor_output' => $this->executor_output,
            'headers' => $this->storage['HEADERS'] ?? null,
            'server' => $this->storage['SERVER'] ?? null ,
            'session' => $this->storage['SESSION'] ?? null,
            'cookies' => $this->storage['COOKIE'] ?? null,
            'markup_language' => $this->markup_language,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'human_date' => $this->human_date,
            'project_title' => $this->project->title,
        ];
    }
}
