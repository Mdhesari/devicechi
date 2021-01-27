<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\Ad;
use Arr;
use DB;
use Ghasedak\GhasedakApi;
use Ghasedak\Laravel\GhasedakServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Reques;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use Laravel\Sanctum\Sanctum;
use Request;
use Schema;
use Str;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Fortify::ignoreRoutes();

        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);

            $this->app->make('config')->set('logging.channels.stack.channels', 'single');
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Schema::defaultStringLength(191);

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Ad::updating(function ($ad) {

            $user = auth()->user();

            // check if ad is already published and user is modifying its data
            // Security: as a concern of adding any invalid or hurtful information or resources we need to sign the ad as uncompleted so the ad will not be shown in the ads home area and users will not be able to access it
            if (
                $user instanceof \Modules\User\Entities\User &&
                $ad->isPublished()
            ) {

                $ad->uncomplete();
            }
        });

        Builder::macro('searchLike', function ($attributes, $searchQuery) {
            foreach (Arr::wrap($attributes) as $attr) {
                $this->when(
                    Str::contains($attr, '.'),
                    // is relation
                    function (Builder $query) use ($attr, $searchQuery) {

                        [$relation, $relationAttr] = explode('.', $attr);

                        $query->whereHas($relation, function (Builder $query) use ($relationAttr, $searchQuery) {
                            $query->orWhere($relationAttr, 'Like', "%{$searchQuery}%");
                        });
                    },
                    // is single attr
                    function (Builder $query) use ($attr, $searchQuery) {

                        $query->where($attr, 'Like', "%{$searchQuery}%");
                    }
                );
            }

            return $this;
        });
    }
}
