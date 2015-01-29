<?php

	namespace PaulMaidment\ORM;

	/**
	* Represents and interface to the table of transactions in this solution
	*/
	interface TransactionTable
	{
		/**
		* Fetch all rows for the given merchant ID from the datasource
		* @param int $merchant_id The ID of the merchant for which the rows are to be fetched
		*/
		public function getAllForMerchantId($merchant_id);
	}
