<?php namespace tkj\Economics\ExtendedVatZone;

use tkj\Economics\ClientInterface as Client;

class ExtendedVatZone {

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
	 * Returns handles for all extended VAT zones with a given number
	 *
	 * @return object[]
	 */
	public function getAll()
	{
		return $this->client
			->ExtendedVatZone_GetAll()
			->ExtendedVatZone_GetAllResult
			->ExtendedVatZoneHandle;
	}

	/**
	 * Gets the name of an extended VAT zone
	 *
	 * @param object $extendedVatZoneHandle
	 *
	 * @return mixed
	 */
	public function getName( $extendedVatZoneHandle )
	{
		return $this->client
			->ExtendedVatZone_GetName(array(
				'extendedVatZoneHandle' => $extendedVatZoneHandle,
			))
			->ExtendedVatZone_GetNameResult;
	}

	/**
	 * Returns extended VAT zone data objects for the given handles
	 *
	 * @param object $extendedVatZoneHandle
	 *
	 * @return mixed
	 */
	public function getDataArray( $extendedVatZoneHandle )
	{
		return $this->client
			->ExtendedVatZone_GetDataArray(array(
				'extendedVatZoneHandles' => array(
					'ExtendedVatZoneHandle' => $extendedVatZoneHandle,
				),
			))
			->ExtendedVatZone_GetDataArrayResult
			->ExtendedVatZoneData;
	}

}
