<?php

use Ivan\CreditCalcBundle\Document\CreditRequest;
use Ivan\CreditCalcBundle\Form\CreditRequestForm;
use Symfony\Component\Form\Test\TypeTestCase;

/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 04.12.17
 * Time: 0:14
 */

class CreditRequestFormTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = array(
            'period'=>24.0,
            'amount'=>100000.0,
            'first_payment_date'=>'2017-12-06',
            'percentage'=>15.0
        );

        $form = $this->factory->create(CreditRequestForm::class);

        $object = CreditRequest::fromArray($formData);

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($object, $form->getData());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}