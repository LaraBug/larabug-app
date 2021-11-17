<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ShowConfigFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'config:list {option=all}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $option = strtolower($this->argument('option'));
        $configs = config();
        $configArray = $configs->all();
        foreach ($configArray as $header => $items) {
            $data = [];
            foreach ($items as $key => $value) {
                if (!is_array($value)) {
                    $data[$header][] = [$key, $value];
                } else {
                    foreach ($value as $arrayItem => $valueItem) {
                        if (!is_array($valueItem)) {
                            $data[$header][] = [$key, $valueItem];
                        }
                    }
                }
            }
            if (array_key_exists($header, $data)) {
                if ($header == $option || $option == 'all') {
                    $this->table([$header, 'value'], $data[$header]);
                }
            }
        }
    }
}
