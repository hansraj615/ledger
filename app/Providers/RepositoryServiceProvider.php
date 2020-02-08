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
use App\Ledger\Repositories\Role\RoleRepository;
use App\Ledger\Repositories\Role\RoleInterface;
use App\Ledger\Repositories\Permission\PermissionInterface;
use App\Ledger\Repositories\Permission\PermissionRepository;
use App\Ledger\Repositories\User\UserInterface;
use App\Ledger\Repositories\User\UserRepository;
use App\Ledger\Repositories\Product\ProductInterface;
use App\Ledger\Repositories\Product\ProductRepository;
use App\Ledger\Repositories\LedgerLogin\LedgerLoginInterface;
use App\Ledger\Repositories\LedgerLogin\LedgerLoginRepository;
/*********************************** */
use App\Ledger\Repositories\Api\Company\CompanyApiInterface;
use App\Ledger\Repositories\Api\Company\CompanyApiRepository;

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
        $this->app->bind(RoleInterface::class, RoleRepository::class);
        $this->app->bind(PermissionInterface::class, PermissionRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(ProductInterface::class, ProductRepository::class);
        $this->app->bind(LedgerLoginInterface::class, LedgerLoginRepository::class);
        $this->app->bind(CompanyApiInterface::class,CompanyApiRepository::class);

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
            RoleInterface::class,
            PermissionInterface::class,
            UserInterface::class,
            ProductInterface::class,
            LedgerLoginInterface::class,
            CompanyApiInterface::class,

        ];
    }
}
