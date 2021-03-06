<?php

/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Identity;

use Guzzle\Common\Collection;
use Guzzle\Http\Message\RequestInterface;
use Guzzle\Service\Client;
use Guzzle\Service\Description\XmlDescriptionBuilder;
use Guzzle\Openstack\Common\AuthenticationObserver;
use Guzzle\Openstack\Common\AbstractClient;

class IdentityClient extends AbstractClient
{

    /**
     * Factory method to create a new IdentityClient
     *
     * @static
     *
     * @param array|Collection $config Configuration data. Array keys:
     *                                 base_url - Identity base url
     *
     * @return \Guzzle\Common\FromConfigInterface|IdentityClient|\Guzzle\Service\Client
     */
    public static function factory($config = array())
    {
        $default = array();
        $required = array('base_url');
        $config = Collection::fromConfig($config, $default, $required);
        $client = new self($config->get('base_url'), $config->get('token'));
        $client->setConfig($config);
        $client->getEventDispatcher()->addSubscriber(new AuthenticationObserver());
        return $client;
    }

    /**
     * Constructor function. If token is not yet present, set to null.
     *
     * @param string $base_url Base Url for keystone
     * @param array|\Guzzle\Common\Collection|null $token
     */
    public function __construct($base_url, $token)
    {
        parent::__construct($base_url);
        $this->setToken($token);
    }
}