<?php namespace tkj\Economics\Account;

use tkj\Economics\ClientInterface as Client;

class Account {

    /**
     * Client Connection
     * @var devdk\Economics\Client
     */
    protected $client;

    /**
     * Instance of Client
     * @var devdk\Economics\Client
     */
    protected $client_raw;

    /**
     * Construct class and set dependencies
     * @param devdk\Economics\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client     = $client->getClient();
        $this->client_raw = $client;
    }

	/**
	 * Get specific Account by number
	 * @param  integer $no
	 * @return object
	 */
	public function get($no)
	{
		$handle = $this->getHandle($no);

		return $this->getArrayFromHandles($handle);
	}


	/**
	 * Get all Accounts
	 *
	 * @return object[]
	 */
	public function getAll()
	{
		$handles = $this->client
			->Account_GetAll()
			->Account_GetAllResult
			->AccountHandle;

		return $this->getArrayFromHandles($handles);
	}

    /**
     * Get Debtor Group handle by number
     * @param  integer $no
     * @return object
     */
    public function getHandle($no)
    {
        if( is_object($no) AND isset($no->Number) ) return $no;

        return $this->client
            ->Account_FindByNumber(array('number'=>$no))
            ->Account_FindByNumberResult;
    }

    /**
     * Get Debtor Groups from handles
     * @param  object $handels
     * @return object
     */
    public function getArrayFromHandles($handles)
    {
        return $this->client
            ->Account_GetDataArray(array('entityHandles'=>$handles))
            ->Account_GetDataArrayResult
            ->AccountData;
    }
}