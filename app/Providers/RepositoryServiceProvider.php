<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Ledger\Repositories\Company\CompanyInterface;
use App\Ledger\Repositories\Company\CompanyRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        //
    }

    public function register()
    {
        $this->app->bind(CompanyInterface::class, CompanyRepository::class);

    }

    public function provides()
    {
        return [
            CompanyInterface::class,

        ];
    }
}
