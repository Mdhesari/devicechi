<?php

namespace App\Space\Traits;

use Exception;

trait HasDomain
{

    /**
     * parse_domain_url
     *
     * @param  mixed $url
     * @return void
     */
    public function parse_domain_url($url, $prefix = '/')
    {
        $domain_info = parse_url($url);

        if (!isset($domain_info['host']))
            throw new Exception('Module host is invalid!');

        if (isset($domain_info['path']))
            $domain = empty(trim($domain_info['path'], '/')) ? $domain_info['host'] : null;
        else
            $domain = $domain_info['host'];

        $path = trim($prefix, '/');

        return [
            'domain' => $domain,
            'path' => $path,
        ];
    }
}
