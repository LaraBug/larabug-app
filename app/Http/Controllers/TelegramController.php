<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Telegram\Bot\Api;
use App\Utilities\InviteToken;

class TelegramController extends Controller
{
    public function generateToken(Request $request, InviteToken $inviteTokenUtility)
    {
        $botHandle = config('services.telegram-bot-api.bot_handle');

        $token = $inviteTokenUtility->generate($request->user());

        $chatId = '';

        if (cache()->has("users.{$request->user()->id}.notifications.telegram_chat_id")) {
            $chatId = cache()->get("users.{$request->user()->id}.notifications.telegram_chat_id");

            cache()->forget("users.{$request->user()->id}.notifications.telegram_chat_id");
        }

        return response()->json([
            'chat_id' => $chatId,
            'token' => $token,
            'handle' => $botHandle,
        ]);
    }

    public function  receiveFromWebhook(Request $request, Api $telegram, InviteToken $inviteTokenUtility)
    {
        $chatId = $request['message']['chat']['id'];
        [$command, $token] = explode(' ', $request['message']['text']);

        if (! in_array($command, ['/start', '/start@'.config('services.telegram-bot-api.bot_handle')])) {
            $telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => 'Unaccepted token',
            ]);

            return response()->noContent();
        }

        if (! $inviteTokenUtility->verify($token)) {
            $telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => 'Unaccepted token',
            ]);

            return response()->noContent();
        }

        $userId = $inviteTokenUtility->data($token);

        cache()->set("users.{$userId}.notifications.telegram_chat_id", $chatId);

        $telegram->sendMessage([
            'chat_id' => $chatId,
            'text' => "You've connected successfully!",
        ]);

        return response()->noContent();
    }
}
