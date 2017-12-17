<?php namespace tkj\Economics\CashBook;

use QuickPay\API\Exception;
use tkj\Economics\ClientInterface as Client;

class CashBookEntry {

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
	 * Create a Debtor Payment CashBook Entry
	 *
	 * @param object $cashBookHandle
	 * @param object $debtorHandle
	 * @param object $contraAccountHandle
	 *
	 * @return object
	 */
	public function createDebtorPayment($cashBookHandle, $debtorHandle, $contraAccountHandle)
	{
		return $cashBookEntryHandle = $this->client
			->CashBookEntry_CreateDebtorPayment(array(
				'cashBookHandle' => $cashBookHandle,
				'debtorHandle' => $debtorHandle,
				'contraAccountHandle' => $contraAccountHandle,
			))
			->CashBookEntry_CreateDebtorPaymentResult;
	}

	/**
	 * Get cashbooks from handles
	 *
	 * @param object $handles
	 *
	 * @return object
	 */
	public function getArrayFromHandles($handles)
	{
		return $this->client
			->CashBookEntry_GetDataArray(array('entityHandles'=>array('CashBookEntryHandle'=>$handles)))
			->CashBookEntry_GetDataArrayResult
			->CashBookEntryData;
	}

}
