<?php

use Tests\CreatesApplication;
use function Pest\Laravel\seed;
use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

uses(
    TestCase::class,
    CreatesApplication::class,
    LazilyRefreshDatabase::class,
    WithFaker::class
)
    ->beforeEach(fn () => seed(DatabaseSeeder::class))
    ->in(__DIR__);
