<?php

namespace Modules\User\Space\Pipelines\AdContact;

use App\Exceptions\MFSValidationException;
use Closure;
use Illuminate\Cache\RateLimiter;
use App\Models\Ad\AdContactType;
use Modules\User\Space\Contracts\AdContactSendVerificationPipeline;

class AdContactPhoneVerificationPipeline implements AdContactSendVerificationPipeline
{

    public function send($data, Closure $next)
    {
        extract($data);

        if ($ad_contact->type->name == AdContactType::TYPE_PHONE) {

            $user = $ad_contact->ad->user;

            $limiter = app(RateLimiter::class);

            $key = make_mobile_limiter_key($user, $ad_contact->value);

            if ($limiter->tooManyAttempts($key, 1)) {

                throw new MFSValidationException([
                    'error' => __('user::global.ratelimiter.global', [
                        'ratelimiter' => $this->getAvailableInRateLimiter($limiter, $key)
                    ]),
                ]);
            }

            $limiter->hit($key, config('user.mobile_rate_limit'));

            $ad_contact->sendVerification([
                'channels' => [
                    // 'ghasedak',
                ],
                'code' => $code
            ]);

            $data['status'] = true;
        }

        return $next($data);
    }

    private function getAvailableInRateLimiter(RateLimiter $limiter, $key)
    {

        return now()->addSeconds($limiter->availableIn($key))->diffInSeconds();
    }
}
