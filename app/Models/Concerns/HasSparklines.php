<?php

namespace App\Models\Concerns;

use App\Models\Exception;
use Illuminate\Support\Str;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

trait HasSparklines
{
    private static int $cacheMinutes = 5;
    private static int $cacheVersion = 1;

    public function getSparkline(int $days = 32): string
    {
        return $this->generateSVGElements(
            Cache::remember(
                sprintf('sparkline-v%d:%s:%s:%d', self::$cacheVersion, class_basename($this), $this->id, $days),
                now()->addMinutes(self::$cacheMinutes),
                fn () => $this->getSVGDataPoints($days),
            ),
        );
    }

    private function getSVGDataPoints(int $days): Collection
    {
        $since = now()->subDays($days)->startOfDay()->toImmutable();

        $points = $this->exceptions()
            ->where('created_at', '>=', $since)
            ->groupByRaw('DATE(`created_at`)')
            ->selectRaw('DATE(`created_at`) as date, COUNT(*) as count')
            ->get()
            ->mapWithKeys(
                static fn (Exception $point) => [$point->getAttribute('date') => $point->getAttributes()]
            );

        // Add missing points
        foreach (range(0, $days) as $offset) {
            $dayString = $since->addDays($offset)->format('Y-m-d');

            $points[$dayString] ??= ['date' => $dayString, 'count' => 0];
        }

        return $points->sortBy('date')->values();
    }

    private function generateSVGElements(Collection $data, int $height = 10): HtmlString
    {
        // Find the largest value to calculate the height of each datapoint
        $max = $data->max('count');

        // The sparkline path
        $svg = sprintf(
            '<path d="%s" stroke="currentColor" vector-effect="non-scaling-stroke"></path>',
            $data->reduce(static function (string $carry, array $point, int $index) use ($max, $height) {
                $directive = $index === 0 ? 'M' : ' L';

                $x = $index * 4;
                $y = $max === 0 || $point['count'] === 0
                    ? $height
                    : number_format(abs((100 * $point['count'] / $max / $height) - $height), 1);

                return "{$carry}{$directive}{$x} {$y}";
            }, '')
        );

        return Str::of($svg)->toHtmlString();
    }

    public function getSparklineAttribute()
    {
        return $this->getSparkline();
    }

    public function initializeHasSparklines()
    {
        $this->append('sparkline');
    }
}