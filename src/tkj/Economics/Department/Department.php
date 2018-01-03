<?php namespace tkj\Economics\Department;

use tkj\Economics\ClientInterface as Client;

class Department {

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
	 * Get all departments
	 *
	 * @return mixed
	 */
	public function all()
	{
		$handles = $this->client
			->Department_GetAll()
			->Department_GetAllResult;

		if ( ! property_exists( $handles, 'DepartmentHandle' ) ) {
			return [];
		}

		return $this->getArrayFromHandles($handles->DepartmentHandle);
	}

	/**
	 * Get cashbooks from handles
	 *
	 * @param object $handles
	 *
	 * @return mixed
	 */
	public function getArrayFromHandles($handles)
	{
		return $this->client
			->Department_GetDataArray(array('entityHandles'=>array('DepartmentHandle'=>$handles)))
			->Department_GetDataArrayResult
			->DepartmentData;
	}

}
