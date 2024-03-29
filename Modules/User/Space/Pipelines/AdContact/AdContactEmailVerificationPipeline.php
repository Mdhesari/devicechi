<?php

namespace Modules\User\Space\Pipelines\AdContact;

use Closure;
use App\Models\Ad\AdContactType;
use Modules\User\Space\Contracts\AdContactSendVerificationPipeline;

class AdContactEmailVerificationPipeline implements AdContactSendVerificationPipeline
{

    public function send($data, Closure $next)
    {
        extract($data);

        if ($ad_contact->type->name == AdContactType::TYPE_EMAIL) {

            $ad_contact->sendVerification([
                'channels' => ['mail'],
                'code' => $code,
            ]);
            $data['status'] = true;
        }

        return $next($data);
    }
}
