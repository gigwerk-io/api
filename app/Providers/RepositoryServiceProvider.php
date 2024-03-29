<?php

namespace App\Providers;

use App\Contracts\Repositories\ApplicationEventRepository;
use App\Contracts\Repositories\ApplicationRepository;
use App\Contracts\Repositories\BusinessAppRepository;
use App\Contracts\Repositories\BusinessFormRepository;
use App\Contracts\Repositories\BusinessIntegrationRepository;
use App\Contracts\Repositories\BusinessLocationRepository;
use App\Contracts\Repositories\BusinessProfileRepository;
use App\Contracts\Repositories\BusinessRepository;
use App\Contracts\Repositories\CategoryRepository;
use App\Contracts\Repositories\ChatMessageRepository;
use App\Contracts\Repositories\ChatRoomRepository;
use App\Contracts\Repositories\DeploymentRepository;
use App\Contracts\Repositories\DeploymentStatusRepository;
use App\Contracts\Repositories\JobIntensityRepository;
use App\Contracts\Repositories\JobStatusRepository;
use App\Contracts\Repositories\MarketplaceJobRepository;
use App\Contracts\Repositories\MarketplaceLocationRepository;
use App\Contracts\Repositories\MarketplaceProposalRepository;
use App\Contracts\Repositories\PasswordResetRepository;
use App\Contracts\Repositories\PaymentMethodRepository;
use App\Contracts\Repositories\PaymentRepository;
use App\Contracts\Repositories\PayoutMethodRepository;
use App\Contracts\Repositories\PayoutRepository;
use App\Contracts\Repositories\ProposalStatusRepository;
use App\Contracts\Repositories\UserLastLocationRepository;
use App\Contracts\Repositories\UserProfileRepository;
use App\Contracts\Repositories\UserRepository;
use App\Contracts\Repositories\UserRoleRepository;
use App\Contracts\Repositories\UserSavedLocationRepository;
use App\Contracts\Repositories\WinkPostRepository;
use App\Repositories\ApplicationEventRepositoryEloquent;
use App\Repositories\ApplicationRepositoryEloquent;
use App\Repositories\BusinessAppRepositoryEloquent;
use App\Repositories\BusinessFormRepositoryEloquent;
use App\Repositories\BusinessIntegrationRepositoryEloquent;
use App\Repositories\BusinessLocationRepositoryEloquent;
use App\Repositories\BusinessProfileRepositoryEloquent;
use App\Repositories\BusinessRepositoryEloquent;
use App\Repositories\CategoryRepositoryEloquent;
use App\Repositories\ChatMessageRepositoryEloquent;
use App\Repositories\ChatRoomRepositoryEloquent;
use App\Repositories\DeploymentRepositoryEloquent;
use App\Repositories\DeploymentStatusRepositoryEloquent;
use App\Repositories\JobIntensityRepositoryEloquent;
use App\Repositories\JobStatusRepositoryEloquent;
use App\Repositories\MarketplaceJobRepositoryEloquent;
use App\Repositories\MarketplaceLocationRepositoryEloquent;
use App\Repositories\MarketplaceProposalRepositoryEloquent;
use App\Repositories\PasswordResetRepositoryEloquent;
use App\Repositories\PaymentMethodRepositoryEloquent;
use App\Repositories\PaymentRepositoryEloquent;
use App\Repositories\PayoutRepositoryEloquent;
use App\Repositories\ProposalStatusRepositoryEloquent;
use App\Repositories\UserLastLocationRepositoryEloquent;
use App\Repositories\UserProfileRepositoryEloquent;
use App\Repositories\UserRepositoryEloquent;
use App\Repositories\UserRoleRepositoryEloquent;
use App\Repositories\UserSavedLocationRepositoryEloquent;
use App\Repositories\WinkPostRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ApplicationRepository::class, function (){
            return $this->app->make(ApplicationRepositoryEloquent::class);
        });

        $this->app->bind(ApplicationEventRepository::class, ApplicationEventRepositoryEloquent::class);

        $this->app->bind(BusinessAppRepository::class, function (){
            return $this->app->make(BusinessAppRepositoryEloquent::class);
        });

        $this->app->bind(BusinessFormRepository::class, BusinessFormRepositoryEloquent::class);

        $this->app->bind(BusinessLocationRepository::class, function (){
            return $this->app->make(BusinessLocationRepositoryEloquent::class);
        });

        $this->app->bind(BusinessIntegrationRepository::class, BusinessIntegrationRepositoryEloquent::class);

        $this->app->bind(BusinessRepository::class, function (){
            return $this->app->make(BusinessRepositoryEloquent::class);
        });

        $this->app->bind(BusinessProfileRepository::class, function (){
            return $this->app->make(BusinessProfileRepositoryEloquent::class);
        });

        $this->app->bind(CategoryRepository::class, function (){
            return $this->app->make(CategoryRepositoryEloquent::class);
        });

        $this->app->bind(ChatMessageRepository::class, function (){
            return $this->app->make(ChatMessageRepositoryEloquent::class);
        });

        $this->app->bind(ChatRoomRepository::class, function (){
            return $this->app->make(ChatRoomRepositoryEloquent::class);
        });

        $this->app->bind(DeploymentRepository::class, DeploymentRepositoryEloquent::class);
        $this->app->bind(DeploymentStatusRepository::class, DeploymentStatusRepositoryEloquent::class);

        $this->app->bind(JobIntensityRepository::class, function (){
            return $this->app->make(JobIntensityRepositoryEloquent::class);
        });

        $this->app->bind(JobStatusRepository::class, function (){
            return $this->app->make(JobStatusRepositoryEloquent::class);
        });

        $this->app->bind(MarketplaceJobRepository::class, function (){
            return $this->app->make(MarketplaceJobRepositoryEloquent::class);
        });

        $this->app->bind(MarketplaceLocationRepository::class, function (){
            return $this->app->make(MarketplaceLocationRepositoryEloquent::class);
        });

        $this->app->bind(MarketplaceProposalRepository::class, function (){
            return $this->app->make(MarketplaceProposalRepositoryEloquent::class);
        });

        $this->app->bind(PasswordResetRepository::class, function (){
            return $this->app->make(PasswordResetRepositoryEloquent::class);
        });

        $this->app->bind(ProposalStatusRepository::class, function (){
            return $this->app->make(ProposalStatusRepositoryEloquent::class);
        });

        $this->app->bind(PaymentRepository::class, function (){
            return $this->app->make(PaymentRepositoryEloquent::class);
        });

        $this->app->bind(PaymentMethodRepository::class, function (){
            return $this->app->make(PaymentMethodRepositoryEloquent::class);
        });

        $this->app->bind(PayoutRepository::class, function (){
            return $this->app->make(PayoutRepositoryEloquent::class);
        });

        $this->app->bind(PayoutMethodRepository::class, function (){
            return $this->app->make(PayoutMethodRepository::class);
        });

        $this->app->bind(UserLastLocationRepository::class, function (){
            return $this->app->make(UserLastLocationRepositoryEloquent::class);
        });

        $this->app->bind(UserProfileRepository::class, function (){
            return $this->app->make(UserProfileRepositoryEloquent::class);
        });

        $this->app->bind(UserRepository::class, function (){
            return $this->app->make(UserRepositoryEloquent::class);
        });

        $this->app->bind(UserRoleRepository::class, function (){
            return $this->app->make(UserRoleRepositoryEloquent::class);
        });

        $this->app->bind(UserSavedLocationRepository::class, function (){
            return $this->app->make(UserSavedLocationRepositoryEloquent::class);
        });

        $this->app->bind(WinkPostRepository::class, function (){
            return $this->app->make(WinkPostRepositoryEloquent::class);
        });
    }
}
