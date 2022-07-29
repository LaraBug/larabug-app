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
            'title' => [
                'required',
                'max:255',
            ],
            'description' => [
                'nullable',
                'max:500',
            ],
            'url' => 'url|nullable',
            'slack_webhook' => [
                'url',
                'nullable',
                'required_if:slack_webhook_enabled,true',
                new StartsWith('https://hooks.slack.com/services/')
            ],
            'discord_webhook' => [
                'url',
                'nullable',
                'required_if:discord_webhook_enabled,true',
                new StartsWith(['https://discordapp.com/api/webhooks/', 'https://discord.com/api/webhooks/', 'https://canary.discord.com/api/webhooks'])
            ],
            'custom_webhook' => [
                'url',
                'nullable',
                'required_if:custom_webhook_enabled,true',
            ],
            'receive_email' => [
                'boolean'
            ],
            'notifications_enabled' => [
                'boolean'
            ],
            'mobile_notifications_enabled' => [
                'boolean'
            ],
            'slack_webhook_enabled' => [
                'boolean'
            ],
            'discord_webhook_enabled' => [
                'boolean'
            ],
            'custom_webhook_enabled' => [
                'boolean'
            ],
            'telegram_notifications_enabled' => [
                'boolean'
            ],
            'telegram_chat_id' => [
                'nullable',
                'required_if:telegram_notifications_enabled,true',
            ]
        ];
    }
}
