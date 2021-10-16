<?php

namespace App\Models;

use Sushi\Sushi;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Sponsor
 *
 * @property int $id
 * @method static \Illuminate\Database\Eloquent\Builder|Sponsor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sponsor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sponsor query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sponsor whereId($value)
 * @mixin \Eloquent
 */
class Sponsor extends Model
{
    use Sushi;

    protected $casts = [
        'created_at' => 'datetime'
    ];

    public function getRows()
    {
        return Cache::remember('sponsors', now()->addHours(12), function () {
            return collect($this->fetchRawSponsors())
                ->map(function ($sponsor) {
                    return [
                        'id' => $sponsor['sponsorEntity']['id'],
                        'tier_id' => $sponsor['tier']['id'],
                        'tier_name' => $sponsor['tier']['name'],
                        'tier_description' => $sponsor['tier']['descriptionHTML'],
                        'tier_price' => $sponsor['tier']['monthlyPriceInDollars'],
                        'tier_price_in_cents' => $sponsor['tier']['monthlyPriceInCents'],
                        'username' => $sponsor['sponsorEntity']['login'],
                        'name' => $sponsor['sponsorEntity']['name'],
                        'email' => $sponsor['sponsorEntity']['email'],
                        'avatar' => $sponsor['sponsorEntity']['avatarUrl'],
                        'location' => $sponsor['sponsorEntity']['location'],
                        'website' => $sponsor['sponsorEntity']['websiteUrl'],
                        'created_at' => $sponsor['createdAt'],
                        'url' => $sponsor['sponsorEntity']['url'],
                    ];
                })
                ->toArray();
        });
    }

    public function fetchRawSponsors($runningSponsors = [], $afterCursor = null)
    {
        $afterCursor = json_encode($afterCursor);

        $response = Http::withToken(
            config('services.github.token')
        )->post('https://api.github.com/graphql', [
            'query' => <<<EOT
            {
                viewer {
                  sponsorshipsAsMaintainer(after: {$afterCursor}, first: 50, includePrivate: true) {
                    nodes {
                      id
                      tier {
                        id
                        descriptionHTML
                        monthlyPriceInDollars
                        monthlyPriceInCents
                        name
                      }
                      sponsorEntity {
                        ... on Organization {
                            avatarUrl
                            email
                            id
                            login
                            name
                            url
                            location
                            websiteUrl
                        }
                        ... on User {
                            avatarUrl
                            email
                            id
                            login
                            name
                            url
                            location
                            websiteUrl
                        }
                      }
                      createdAt
                    }
                    totalCount
                    pageInfo {
                      hasNextPage
                      endCursor
                    }
                  }
                }
              }
            EOT,
        ]);

        $sponsors = $response['data']['viewer']['sponsorshipsAsMaintainer']['nodes'];
        $hasNextPage = $response['data']['viewer']['sponsorshipsAsMaintainer']['pageInfo']['hasNextPage'];
        $endCursor = $response['data']['viewer']['sponsorshipsAsMaintainer']['pageInfo']['endCursor'];

        $allSponsors = array_merge($runningSponsors, $sponsors);

        if (!$hasNextPage) {
            return $allSponsors;
        }

        return $this->fetchRawSponsors($allSponsors, $endCursor);
    }
}
