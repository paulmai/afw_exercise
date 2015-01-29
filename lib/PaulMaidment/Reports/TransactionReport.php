<?php

	namespace PaulMaidment\Reports;
	
	use PaulMaidment\Services\CurrencyService;
	use PaulMaidment\ORM\TransactionTable;

	/**
	 * The class that fetches the transaction report 
	 **/
	class TransactionReport
	{

		private $currencyService;
		private $transactionTable;

		public function __construct(CurrencyService $currencyService, TransactionTable $transactionTable)
		{
			$this->currencyService = $currencyService;
			$this->transactionTable = $transactionTable;
		}

		/**
		* Get all of the transaction rows for the given merchant id
		* @param int $merchant_id The merchant ID to get transaction rows for
		* @param string $currency The shortcode for the currency to filter by (such as 'GBP')
		* @return array The transaction rows for the given merchant id
		**/
		public function getAllTransactionsForMerchantId($merchant_id,$currency)
		{
			$result = array();

			//Get all of the matching transactions for the merchant
			$rows = $this->transactionTable->getAllForMerchantId($merchant_id);

			foreach($rows as $current)
			{
				//Convert the value to another currency
				$current['value'] = $this->currencyService->convertValueToAnotherCurrency($current['value'],'GBP');
				$result []= $current;
			}			
			return $result;
		}
	}
