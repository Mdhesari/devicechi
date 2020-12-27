<?php

namespace Modules\User\Space\Pipelines\AdContact;

use App\Exceptions\MFSValidationException;
use Closure;
use Illuminate\Cache\RateLimiter;
use Modules\User\Entities\Ad\AdContactType;
use Modules\User\Space\Contracts\AdContactSendVerificationPipeline;

class AdContactPhoneVerificationPipeline implements AdContactSendVerificationPipeline
{

    public function send($data, Closure $next)
    {
        extract($data);

        if ($ad_contact->type->name == AdContactType::TYPE_PHONE) {

            $user = $ad_contact->ad->user;

            $limiter = app(RateLimiter::class);

            $key = make_mobile_limiter_key($user);

            if ($limiter->tooManyAttempts($key, 1)) {

                throw new MFSValidationException(back()->with([
                    'error' => __('Something Went Wrong!'),
                    'ratelimiter' => $this->getAvailableInRateLimiter($limiter, $key)
                ]));
            }

            $limiter->hit($key, config('user.mobile_rate_limit'));

            $ad_contact->sendVerification([
                'channels' => 'mail',
            ]);
            $data['status'] = true;
        }

        return $next($data);
    }
}
