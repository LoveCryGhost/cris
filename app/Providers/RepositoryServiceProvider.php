<?php

namespace App\Providers;

use App\Repositories\Member\MemberRepository;
use App\Repositories\Member\MemberRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            MemberRepositoryInterface::class,
            MemberRepository::class
        );
    }
}