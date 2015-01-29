<?php
	
	namespace PaulMaidment\Test;

	use PaulMaidment\ORM\TransactionTable;

	/**
	* Mock implementation of TransactionTable to test consumers of TransactionTable
	* TransactionTable represents the interface to a DB table, an ORM as such
	**/
	class TransactionTableMock implements TransactionTable
	{
		private $data;
		
		/**
		* Construct the Table Mock with some injected data.
		* @param array $data The mocked data to be used as data for the table
		**/
		public function __construct(array $data)
		{
			$this->data = $data;
		}

		/**
		* Filter by merchant ID and return all matching rows from the datasource
		* @param int $merchant_id The merchant ID for which the rows are to be fetched.
		*/
		public function getAllForMerchantId($merchant_id)
		{
			$result = array();
			foreach($this->data as $transaction)
			{
				if($transaction['merchant_id'] == $merchant_id)
				{
					$result []= $transaction;
				}
			}
			return $result;
		}
	} 
