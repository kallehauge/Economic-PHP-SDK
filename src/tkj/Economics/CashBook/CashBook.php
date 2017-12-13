<?php namespace tkj\Economics\CashBook;

use tkj\Economics\ClientInterface as Client;

class CashBook {

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
	 * Get specific CashBook by number
	 * @param  integer $no
	 * @return object
	 */
	public function get($no)
	{
		$handle = $this->getHandle($no);

		return $this->getArrayFromHandles($handle);
	}

	/**
	 * Get CashBook handle by number
	 * @param  integer $no
	 * @return object
	 */
	public function getHandle($no)
	{
		if( is_object($no) AND isset($no->Id) ) return $no;

		if( @$result = $this->client
			->CashBook_FindByNumber(array('number'=>$no))
			->CashBook_FindByNumberResult
		) return $result;
	}

	/**
	 * Get all CashBooks
	 *
	 * @return object[]
	 */
	public function getAll()
	{
		$handles = $this->client
			->CashBook_GetAll()
			->CashBook_GetAllResult
			->CashBookHandle;

		return $this->getArrayFromHandles($handles);
	}

	/**
	 * Get cashbooks from handles
	 *
	 * @param object $handels
	 *
	 * @return object
	 */
	public function getArrayFromHandles($handles)
	{
		return $this->client
			->CashBook_GetDataArray(array('entityHandles'=>array('CashBookHandle'=>$handles)))
			->CashBook_GetDataArrayResult
			->CashBookData;
	}

}
