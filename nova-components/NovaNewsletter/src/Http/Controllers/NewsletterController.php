<?php

namespace LaraBug\NovaNewsLetter\Http\Controllers;

use App\Mail\Admin\Newsletter;
use App\Models\Server;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Laravel\Nova\Http\Requests\NovaRequest;

class NewsletterController extends Controller
{
    use ValidatesRequests;

    public function reach(Request $request)
    {
        $users = $this->calculateReach($request);

        return [
            'total' => $users->count()
        ];
    }

    public function send(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required|string',
            'content' => 'required|string'
        ]);

        $reach = $this->calculateReach($request);

        $total = $reach->count();

        $reach->chunk(50, function ($users) use ($request) {
            foreach ($users as $user) {
                Mail::mailer('mailgun')->to($user)->queue(new Newsletter($user, $request->input('subject'), $request->input('content')));
            }
        });

        return response('Newsletter will be send to ' . $total . ' subscriber(s)');
    }

    protected function calculateReach(Request $request): Builder
    {
        return User::query()
            ->when(filter_var($request->input('test'), FILTER_VALIDATE_BOOLEAN), function ($query) {
                return $query->where('id', auth()->id());
            })
            ->when(filter_var($request->input('newsletter_preference'), FILTER_VALIDATE_BOOLEAN), function ($query) {
                return $query->where('newsletter', 1);
            })
            ->when($request->input('user_plan'), function ($query, $value) {
                return $query->where('plan_id', $value);
            })
            ->when(filter_var($request->input('trial_users'), FILTER_VALIDATE_BOOLEAN), function ($query) {
                return $query->where('trial', 1);
            })
            ->when($request->input('user_age', 0) > 0, function ($query, $value) use ($request) {
                return $query->where('created_at', '>', now()->subMonths((int)$request->input('user_age')));
            });
    }
}
