<?php
/**
 * @license See the LICENSE file that was distributed with this source code.
 */

namespace Guzzle\Openstack\Compute;

use Guzzle\Common\Collection;
use Guzzle\Http\Message\RequestInterface;
use Guzzle\Openstack\Common\AbstractClient;
use Guzzle\Service\Description\XmlDescriptionBuilder;
use Guzzle\Openstack\Common\AuthenticationObserver;

class ComputeClient extends AbstractClient
{
	protected $baseUrl, $tenantId;

	/**
	 * Factory method to create a new ComputeClient
	 *
	 * @static
	 *
	 *
	 * @param array|Collection $config Configuration data. Array keys:
	 *                                 base_url - Base URL of web service
	 *                                 token - Authentication token
	 *                                 tenant_id Tenant id
	 *
	 * @return \Guzzle\Common\FromConfigInterface|ComputeClient|\Guzzle\Service\Client
	 */
	public static function factory($config = array())
	{
		$default = array();
		$required = array('base_url', 'token');
		$config = Collection::fromConfig($config, $default, $required);
		$client =
			new self($config->get('base_url'), $config->get('token'), $config->get(
				'tenant_id'
			));
		$client->setConfig($config);
		$client->getEventDispatcher()->addSubscriber(new AuthenticationObserver());
		return $client;
	}

	/**
	 * ComputeClient constructor
	 *
	 * @param string $baseUrl Base URL for Nova
	 * @param string $token   Authentication token
	 * @param string $tenantId
	 */
	public function __construct($baseUrl, $token, $tenantId)
	{
		parent::__construct($baseUrl);
		$this->setToken($token);
		$this->setTenantId($tenantId);
	}

	/**
	 * Set the tenantId for this client.
	 *
	 * @param string $tenantId
	 */
	public function setTenantId($tenantId)
	{
		$this->tenantId = $tenantId;
	}

	/**
	 * Get the tenantId for this client.
	 *
	 * @return string
	 */
	public function getTenantId()
	{
		return $this->tenantId;
	}

}