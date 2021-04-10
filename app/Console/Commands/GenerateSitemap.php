<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Psr\Http\Message\UriInterface;
use Spatie\Sitemap\SitemapGenerator;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    protected $disabledUrls = [
        '/login/github',
        '/login/bitbucket'
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        SitemapGenerator::create('https://www.larabug.com')
            ->shouldCrawl(function (UriInterface $url) {
                if (in_array($url->getPath(), $this->disabledUrls)) {
                    return false;
                }

                return true;
            })
            ->writeToFile(public_path('sitemap.xml'));
    }
}
