<?php
	//Load the composer autoloader.
	require_once(dirname(__FILE__).'/../vendor/autoload.php');

	//Set up dependency injection
        use DI\ContainerBuilder;

	class TransactionReportTest extends PHPUnit_Framework_TestCase
	{
		private $container;
                private $transactionReport;

                public function __construct()
                {
			$containerBuilder = new \DI\ContainerBuilder();
			$containerBuilder->setDefinitionCache(new Doctrine\Common\Cache\ArrayCache());
			$containerBuilder->addDefinitions('config.php');
                        $this->container = $containerBuilder->build();
                }

		public function setUp()
		{
			$this->transactionReport = $this->container->get('TransactionReport');	
		}

		public function test_TransactionReport_must_be_instantiated()
		{
			$this->assertNotNull($this->transactionReport);
		}

		public function test_TransactionReport_returns_data_for_merchant()
		{
			$transactionData = $this->transactionReport->getAllTransactionsForMerchantId(2,'GBP');
			$this->assertGreaterThan(0,sizeof($transactionData));
		}

		public function test_TransactionReport_returns_correct_values_for_merchants_in_currency()
		{
			//Load the unit test data from the config
			$unit_test_data = $this->container->get('tests');
			foreach($unit_test_data as $current)
			{
				$actual = $this->transactionReport->getAllTransactionsForMerchantId($current['merchant_id'],$current['currency']);
				$expected = $current['expected'];
				$this->assertEquals($expected,$actual);
			}
		}
		
	} 
