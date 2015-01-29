<?php

	//Load the composer autoloader
	require_once(dirname(__FILE__).'/vendor/autoload.php');

	//Set up dependency injection
        use DI\ContainerBuilder;
		
	/**
	* Proposed solution to AffiliateWindow Exercise
	* @author Paul Maidment
	* @date 29th January 2015
	**/
	class Solution
	{
		/**
		* The main method of the solution
		* @param array $arguments Any command line arguments 
		**/
		public static function main(array $arguments)
		{
			if(sizeof($arguments) > 1) {

				//Obtain the merchant id from command line parameters
				$merchant_id = intval($arguments[1]); 
	
				//Launch the DI container and load the config
				$containerBuilder = new \DI\ContainerBuilder();
				$containerBuilder->setDefinitionCache(new Doctrine\Common\Cache\ArrayCache());
				$containerBuilder->addDefinitions('config.php');
                        	$container = $containerBuilder->build();

				//Get the transaction report engine
				$transactionReport = $container->get('TransactionReport');
				$transactions = $transactionReport->getAllTransactionsForMerchantId($merchant_id,'GBP');

				//Print out the report
				$output = '';
				$header = str_pad('Merchant ID',15,' ').str_pad('Date',15,' ').str_pad('Value',20,' ')."\n";
				$output .= $header;
				foreach($transactions as $transaction)
				{
					$row = 	 str_pad($transaction['merchant_id'],15,' ')
						.str_pad($transaction['date'],15,' ')
						.str_pad($transaction['value'],20,' ')."\n";
					$output .= $row;
				}			

				//Echo the report to output
				echo("\n".$output."\n");				
				
			} else {
				echo "No merchant ID supplied\nUsage: php solution.php <merchant_id>\n";
				return;
			}
			
		}
	}

	Solution::main($argv);
