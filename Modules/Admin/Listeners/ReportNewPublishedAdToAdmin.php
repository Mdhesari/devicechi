<?php

namespace Modules\Admin\Listeners;

use App\Events\NewAdPublishedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;
use Modules\Admin\Entities\Admin;
use Modules\Admin\Notifications\AdminNewPublishedAdNotification;
use Notification;

class ReportNewPublishedAdToAdmin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NewAdPublishedEvent $event)
    {
        Notification::send(Admin::all(), new AdminNewPublishedAdNotification($event->ad));

        Log::stack(['single', 'slack'])->info(__("admin::ads.published", [
            'user' => $event->ad->user->phone,
            'brand' => $event->ad->phoneModel->brand->name,
        ]));
    }
}
