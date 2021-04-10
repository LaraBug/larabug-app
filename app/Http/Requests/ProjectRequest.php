<?php

namespace App\Http\Requests;

use App\Rules\StartsWith;
use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'description' => [
                'nullable',
                'max:500',
            ],
            'url' => 'url|nullable',
            'slack_webhook' => [
                'url',
                'nullable',
                new StartsWith('https://hooks.slack.com/services/')
            ],
            'discord_webhook' => [
                'url',
                'nullable',
                new StartsWith(['https://discordapp.com/api/webhooks/', 'https://discord.com/api/webhooks/'])
            ],
        ];
    }
}
