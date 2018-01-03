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
	 * Create a Creditor Payment CashBook Entry
	 *
	 * @param object $cashBookHandle
	 * @param object $creditorHandle
	 * @param object $contraAccountHandle
	 *
	 * @return object
	 */
	public function createCreditorPayment($cashBookHandle, $creditorHandle, $contraAccountHandle)
	{
		return $cashBookEntryHandle = $this->client
			->CashBookEntry_CreateCreditorPayment(array(
				'cashBookHandle' => $cashBookHandle,
				'creditorHandle' => $creditorHandle,
				'contraAccountHandle' => $contraAccountHandle,
			))
			->CashBookEntry_CreateCreditorPaymentResult;
	}

	/**
	 * Set a Debtor Invoice Number
	 *
	 * @param object $cashBookEntryHandle
	 * @param int $debtorInvoiceNo
	 *
	 * @return object
	 */
	public function setDebtorInvoiceNumber($cashBookEntryHandle, $debtorInvoiceNo)
	{
		return $this->client
			->CashBookEntry_SetDebtorInvoiceNumber(array(
				'cashBookEntryHandle' => $cashBookEntryHandle,
				'value' => $debtorInvoiceNo,
			));
	}

	/**
	 * Set a Creditor Invoice Number
	 *
	 * @param object $cashBookEntryHandle
	 * @param int $creditorInvoiceNo
	 *
	 * @return object
	 */
	public function setCreditorInvoiceNumber($cashBookEntryHandle, $creditorInvoiceNo)
	{
		return $this->client
			->CashBookEntry_SetCreditorInvoiceNumber(array(
				'cashBookEntryHandle' => $cashBookEntryHandle,
				'value' => $creditorInvoiceNo,
			));
	}

	/**
	 * Set the currency
	 *
	 * @param object $cashBookEntryHandle
	 * @param object $currencyHandle
	 *
	 * @return object
	 */
	public function setCurrency($cashBookEntryHandle, $currencyHandle)
	{
		return $this->client
			->CashBookEntry_SetCurrency(array(
				'cashBookEntryHandle' => $cashBookEntryHandle,
				'valueHandle' => $currencyHandle,
			));
	}

	/**
	 * Set amount
	 *
	 * @param object $cashBookEntryHandle
	 * @param float $amount
	 *
	 * @return object
	 */
	public function setAmount($cashBookEntryHandle, $amount)
	{
		return $this->client
			->CashBookEntry_SetAmount(array(
				'cashBookEntryHandle' => $cashBookEntryHandle,
				'value' => (float) $amount,
			));
	}

	/**
	 * Set default currency amount
	 *
	 * @param object $cashBookEntryHandle
	 * @param float $amount
	 *
	 * @return object
	 */
	public function setDefaultCurrencyAmount($cashBookEntryHandle, $amount)
	{
		return $this->client
			->CashBookEntry_SetAmountDefaultCurrency(array(
				'cashBookEntryHandle' => $cashBookEntryHandle,
				'value' => (float) $amount,
			));
	}

	/**
	 * Set text
	 *
	 * @param object $cashBookEntryHandle
	 * @param string $text
	 *
	 * @return object
	 */
	public function setText($cashBookEntryHandle, $text)
	{
		return $this->client
			->CashBookEntry_SetText(array(
				'cashBookEntryHandle' => $cashBookEntryHandle,
				'value' => $text,
			));
	}

	/**
	 * Set department
	 *
	 * @param object $cashBookEntryHandle
	 * @param object $valueHandle
	 *
	 * @return mixed
	 */
	public function setDepartment($cashBookEntryHandle, $valueHandle)
	{
		if ( is_numeric( $valueHandle ) ) {
			$value = $valueHandle;
			$valueHandle = new \stdClass();
			$valueHandle->Number = $value;
		}

		return $this->client
			->CashBookEntry_SetDepartment(array(
				'cashBookEntryHandle' => $cashBookEntryHandle,
				'valueHandle' => $valueHandle,
			));
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
