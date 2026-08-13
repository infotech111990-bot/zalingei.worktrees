<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Symfony\Component\HttpFoundation\Request;

class TrustProxies extends Middleware
{
    /**
     * Railway terminates TLS at the edge and forwards the request to the
     * Laravel container. Trust the forwarded headers so Laravel generates
     * HTTPS URLs and secure form actions behind the proxy.
     *
     * @var array|string|null
     */
    protected $proxies = '*';

    /**
     * @var int
     */
    protected $headers =
        Request::HEADER_X_FORWARDED_FOR |
        Request::HEADER_X_FORWARDED_HOST |
        Request::HEADER_X_FORWARDED_PORT |
        Request::HEADER_X_FORWARDED_PROTO;
}
