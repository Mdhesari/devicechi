<?php

namespace App\Providers;

use App\Models\Ad;
use Arr;
use DB;
use Ghasedak\GhasedakApi;
use Ghasedak\Laravel\GhasedakServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Reques;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;
use Request;
use Schema;
use SEOMeta;
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

        Builder::macro('searchWhereHas', function ($query, $attr, $searchQuery) {

            $attrArr = explode('.', $attr);

            $relation = $attrArr[0];

            $relationAttr = $attrArr[1];

            return $query->orWhereHas($relation, function (Builder $query) use ($relationAttr, $searchQuery, $attrArr, $relation) {

                if (isset($attrArr[2])) {

                    $relation = $attrArr[1];
                    $relationAttr = $attrArr[2];

                    return $query->whereHas($relation, function ($query) use ($searchQuery, $relationAttr) {

                        $query->Where($relationAttr, 'Like', $searchQuery);
                    });
                }

                return $query->Where($relationAttr, 'Like', $searchQuery);

                // $query->when(
                //     count($attrArr) > 2,
                //     function (Builder $query) use ($attrArr, $searchQuery) {

                //         unset($attrArr[0]);
                //         $relationAttr = join('.', $attrArr);

                //         return $this->searchWhereHas($query, $relationAttr, $searchQuery);
                //     },
                //     function (Builder $query) use ($relationAttr, $searchQuery, $relation) {
                //         return $query->where($relationAttr, 'Like', $searchQuery);
                //     }
                // );
            });
        });

        Builder::macro('searchLike', function ($attributes, $searchQuery) {
            foreach (Arr::wrap($attributes) as $attr) {
                $this->when(
                    Str::contains($attr, '.'),
                    // is relation
                    function (Builder $query) use ($attr, $searchQuery) {

                        $query = $this->searchWhereHas($query, $attr, "%{$searchQuery}%");

                        // $attrArr = explode('.', $attr);

                        // $relation = $attrArr[0];

                        // $relationAttr = $attrArr[1];

                        // $query->orWhereHas($relation, function (Builder $query) use ($relationAttr, $searchQuery) {
                        //     $query->Where($relationAttr, 'Like', "%{$searchQuery}%");
                        // });
                    },
                    // is single attr
                    function (Builder $query) use ($attr, $searchQuery) {

                        $query->orWhere($attr, 'Like', "%{$searchQuery}%");
                    }
                );
            }

            return $this;
        });
    }
}
