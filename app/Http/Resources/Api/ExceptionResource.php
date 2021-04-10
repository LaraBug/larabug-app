<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ExceptionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /* @var $this \App\Models\Exception */
        return [
            'id' => $this->id,
            'project_id' => $this->project_id,
            'class' => $this->class,
            'error' => $this->error,
            'exception' => $this->exception,
            'line' => $this->line,
            'file' => $this->file,
            'url' => $this->fullUrl,
            'route_url' => $this->route_url,
            'executor' => $this->executor,
            'executor_output' => $this->executor_output,
            'markup_language' => $this->markup_language,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'human_date' => $this->human_date,
        ];
    }
}
