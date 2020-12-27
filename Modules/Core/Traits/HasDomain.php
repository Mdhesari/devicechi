<?php

namespace Modules\Core\Traits;

use Exception;

trait HasDomain
{

    /**
     * Module domain
     *
     * @var mixed
     */
    protected $domain;

    /**
     * Url prefix
     *
     * @var string
     */
    protected $path;

    /**
     * parse_domain_url
     *
     * @param  mixed $url
     * @return void
     */
    public function parseDomainUrl($url, $prefix = '/')
    {
        $domain_info = parse_url($url);
        if (!isset($domain_info['host']))
            throw new Exception('Module host is invalid!');

        if (isset($domain_info['path']))
            $domain = empty(trim($domain_info['path'], '/')) ? $domain_info['host'] : null;
        else
            $domain = $domain_info['host'];

        $path = trim($prefix, '/');

        $this->domain = $domain;

        return [
            'domain' => $domain,
            'path' => $path,
        ];
    }

    /**
     * Get current domain
     *
     * @return void
     */
    public function getDomain()
    {

        return $this->domain;
    }

    /**
     * get Current path
     *
     * @return void
     */
    public function getPrefix()
    {

        return $this->path;
    }
}
