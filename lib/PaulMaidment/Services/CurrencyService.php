<?php

	namespace PaulMaidment\Services;

	/**
	* Service to assist with the determination of currency for supplied data 
	* @author Paul Maidment
	*
	**/
	class CurrencyService
	{
		private $currencies;

		/**
		* Construct the service with an injected array of currencies
		* @param array $currencies The currency configuration array
		**/
		public function __construct(array $currencies)
		{
			$this->currencies = $currencies;
		}

		public function getCurrencyByCode($code)
		{
			foreach($this->currencies as $current)
			{
				if($current['Currency'] == $code)
				{
					return $current;
				}
			}
		}
		
		public function getCurrencyBySymbol($symbol)
		{
			foreach($this->currencies as $current)
                        {
                                if($current['Symbol'] == $symbol)
                                {
                                        return $current;
                                }
                        }

		}
		
		/**
		* Convert the supplied value to another currency
		* @param string $value The value including the currency prefix, for example £
		**/
		public function  convertValueToAnotherCurrency($value,$targetCurrencyCode)
		{
			$symbol = mb_substr($value, 0, 1, 'utf-8');
			$value = str_replace($symbol,'',$value);
			$source_currency = $this->getCurrencyBySymbol($symbol);
			$destination_currency = $this->getCurrencyByCode($targetCurrencyCode);
			$new_value = ($source_currency['ExchangeRate'] * $value);
			$value = $destination_currency['Symbol']."".number_format($new_value,2);
			return $value;
		}

	}
