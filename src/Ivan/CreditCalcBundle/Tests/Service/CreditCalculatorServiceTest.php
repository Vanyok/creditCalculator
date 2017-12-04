<?php

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 04.12.17
 * Time: 8:50
 */

class CreditCalculatorServiceTest extends KernelTestCase
{

    private $calculator;

    private  $dataSet = [
        [0=>10000,1=>15,2=>6,'month'=>1740.34,'perc'=>125],
        [0=>80000,1=>1,2=>8,'month'=>10037.54,'perc'=>66.67],
        [0=>100,1=>55,2=>24,'month'=>6.96,'perc'=>4.58],
        [0=>100000000,1=>75,2=>15,'month'=>10465123.07,'perc'=>6250000.00],
    ];

    protected function setUp()
    {
        self::bootKernel();

        $this->calculator = static::$kernel
            ->getContainer()
            ->get('ivan_credit_calc.credit_calculator');
    }

    public function testCalculatePaymentPerMonth(){

        foreach ($this->dataSet as $set){
            $this->assertEquals(number_format($set['month'],2),number_format($this->calculator->calculatePaymentPerMonth($set[0],$set[1],$set[2]),2));
        }
    }

    public function testCalculatePercentagePayment(){
        foreach ($this->dataSet as $set){
            $this->assertEquals(number_format($set['perc'],2),number_format($this->calculator->calculatePercentagePayment($set[0],$set[1]),2));
        }
    }
}