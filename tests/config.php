<?php
	
	return [

		/**
		* Mock database data, will be injected into the mock TransactionTable 
		*/
		'testdata.transactions' => [
			[
				'merchant_id' => 1,
				'date' => '01/05/2010',
				'value' => '£50.00'
			],
			[
                                'merchant_id' => 2,
                                'date' => '01/05/2010',
                                'value' => '$66.00'
                        ],
			[
                                'merchant_id' => 2,
                                'date' => '02/05/2010',
                                'value' => '€12.00'
                        ],
			[
                                'merchant_id' => 2,
                                'date' => '02/05/2010',
                                'value' => '£6.50'
                        ],
			[
                                'merchant_id' => 1,
                                'date' => '02/05/2010',
                                'value' => '£11.04'
                        ],
			[
                                'merchant_id' => 1,
                                'date' => '02/05/2010',
                                'value' => '€1.00'
                        ],
			[
                                'merchant_id' => 1,
                                'date' => '03/05/2010',
                                'value' => '$23.05'
                        ],
			[
                                'merchant_id' => 2,
                                'date' => '04/05/2010',
                                'value' => '€6.50'
                        ],
			
		],
		
		/*
			PHPUnit assertions on the returned data 
			Tests of merchant id / currency filters and the expected rows / values
			This is data to drive unit tests of this
		*/
		'tests' => [
			[
				'merchant_id' => 1,
				'currency' => 'GBP',
				'expected' => [
					[
						'merchant_id' => 1,
                                                'date' => '01/05/2010',
                                                'value' => '£50.00'
                                        ],
					[
                                                'merchant_id' => 1,
                                                'date' => '02/05/2010',
                                                'value' => '£11.04'
                                        ],
					[
                                                'merchant_id' => 1,
                                                'date' => '02/05/2010',
                                                'value' => '£0.75'
                                        ],
					[
                                                'merchant_id' => 1,
                                                'date' => '03/05/2010',
                                                'value' => '£15.21'
                                        ]
					
				]
			],
			[
                                'merchant_id' => 2,
                                'currency' => 'GBP',
                                'expected' => [
                                        [
						'merchant_id' => 2,
                                		'date' => '01/05/2010',
                                		'value' => '£43.56'
                                        ],
					[
                                                'merchant_id' => 2,
                                                'date' => '02/05/2010',
                                                'value' => '£9.00'
                                        ],
					[
                                                'merchant_id' => 2,
                                                'date' => '02/05/2010',
                                                'value' => '£6.50'
                                        ],
					[
                                                'merchant_id' => 2,
                                                'date' => '04/05/2010',
                                                'value' => '£4.88'
                                        ]

                                ]
                        ]	
		],

		/**
		* Sample currency configuration for the CurrencyService
		**/
		'currencies' => [

			[
				'Currency' => 'GBP',
				'ExchangeRate' => '1',
				'Symbol' => '£'
			],
			[
				'Currency' => 'USD',
				'ExchangeRate' => '0.66',
				'Symbol' => '$'
			],
			[
				'Currency' => 'EUR',
				'ExchangeRate' => 0.75,
				'Symbol' => '€'
			]

		],

		/**
		* Our PHP-DI dependency injection definitions, setting up our mock environment
		**/
		'CurrencyService' => DI\factory(function (DI\Container $c) {

			return new PaulMaidment\Services\CurrencyService($c->get('currencies'));

		}),

		'TransactionTable' => DI\factory(function (DI\Container $c) {

			return new PaulMaidment\Test\TransactionTableMock($c->get('testdata.transactions'));

		}),

		'TransactionReport' => DI\factory(function (DI\Container $c) {

                        return new PaulMaidment\Reports\TransactionReport($c->get('CurrencyService'),$c->get('TransactionTable'));

                }),

	];
