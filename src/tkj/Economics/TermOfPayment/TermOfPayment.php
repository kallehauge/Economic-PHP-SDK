<?php namespace tkj\Economics\TermOfPayment;

use tkj\Economics\ClientInterface as Client;

class TermOfPayment {

	/**
	 * Client Connection
	 * @var \tkj\Economics\Client
	 */
	protected $client;

	/**
	 * Instance of Client
	 * @var \tkj\Economics\Client
	 */
	protected $client_raw;

	/**
	 * Construct class and set dependencies
	 *
	 * @param \tkj\Economics\ClientInterface $client
	 */
	public function __construct(Client $client)
	{
		$this->client     = $client->getClient();
		$this->client_raw = $client;
	}

	/**
	 * Returns handles for all terms of payments
	 *
	 * @return object[]
	 */
	public function getAll()
	{
		return $this->client
			->TermOfPayment_GetAll()
			->TermOfPayment_GetAllResult
			->TermOfPaymentHandle;
	}

	/**
	 * Returns term of payment data objects for a given set of term of payment handles
	 *
	 * @param object|array $entityHandles
	 *
	 * @return mixed
	 */
	public function getDataArray( $entityHandles )
	{
		return $this->client
			->TermOfPayment_GetDataArray(array(
				'entityHandles' => array(
					'TermOfPaymentHandle' => $entityHandles,
				),
			))
			->TermOfPayment_GetDataArrayResult
			->TermOfPaymentData;
	}

}
