<?php

declare(strict_types=1);

namespace Common\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Middleware to implement the PRG Pattern in a Zend Expressive app
 */
class StaticPageHandlerCacheMiddleware  implements MiddlewareInterface
{

    private $config;

    public function __construct( array $config ) {
        $this->config = $config;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler) : Response
    {
        $response = $handler->handle($request);

        // check if current route has cache enabled
        if( array_key_exists('enabled',$this->config)
            && $this->config['enabled']
        ) {
            $url = str_replace('/', '_',	$request->getUri()->getPath());
            $file = $this->config['path'] . $url . '.html';

            if( file_exists($file)
                && (time() - filemtime($file)) < $this->config['lifetime']
            )
            {
                return new HtmlResponse(file_get_contents($file));
            }

            if ($response instanceof HtmlResponse)
            {
                file_put_contents($file, $response->getBody());
            }
        }

        return	$response;
    }

}
