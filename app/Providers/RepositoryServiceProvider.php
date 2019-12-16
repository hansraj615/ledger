<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Ledger\Repositories\Company\CompanyInterface;
use App\Ledger\Repositories\Company\CompanyRepository;
use App\Ledger\Repositories\SubCompany\SubCompanyInterface;
use App\Ledger\Repositories\SubCompany\SubCompanyRepository;
use App\Ledger\Repositories\SubCompanyStock\SubCompanyStockInterface;
use App\Ledger\Repositories\SubCompanyStock\SubCompanyStockRepository;
use App\Ledger\Repositories\Client\ClientInterface;
use App\Ledger\Repositories\Client\ClientRepository;
use App\Ledger\Repositories\LedgerEntry\LedgerEntryInterface;
use App\Ledger\Repositories\LedgerEntry\LedgerEntryRepository;
use App\Ledger\Repositories\ClientMapping\ClientMappingInterface;
use App\Ledger\Repositories\ClientMapping\ClientMappingRepository;

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
         $this->app->bind(SubCompanyInterface::class, SubCompanyRepository::class);
         $this->app->bind(SubCompanyStockInterface::class, SubCompanyStockRepository::class);
         $this->app->bind(ClientInterface::class, ClientRepository::class);
         $this->app->bind(LedgerEntryInterface::class, LedgerEntryRepository::class);
         $this->app->bind(ClientMappingInterface::class, ClientMappingRepository::class);

    }

    public function provides()
    {
        return [
            CompanyInterface::class,
            SubCompanyInterface::class,
            SubCompanyStockInterface::class,
            ClientInterface::class,
            LedgerEntryInterface::class,
            ClientMappingInterface::class,
            


        ];
    }
}
