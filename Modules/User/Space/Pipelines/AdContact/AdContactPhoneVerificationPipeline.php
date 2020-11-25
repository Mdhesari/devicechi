<?php

namespace Modules\User\Space\Pipelines\AdContact;

use Closure;
use Modules\User\Entities\Ad\AdContactType;
use Modules\User\Space\Contracts\AdContactSendVerificationPipeline;

class AdContactPhoneVerificationPipeline implements AdContactSendVerificationPipeline
{

    public function send($data, Closure $next)
    {
        extract($data);

        if ($ad_contact->type->name == AdContactType::TYPE_PHONE) {

            $ad_contact->sendVerification([
                'channels' => 'mail',
            ]);
            $data['status'] = true;
        }

        return $next($data);
    }
}
