<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 03.12.17
 * Time: 18:41
 */

namespace Ivan\CreditCalcBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\Annotations\Field;
/**
 * @MongoDB\Document
 */


class CreditCalculation
{
    /**
     * @MongoDB\Id
     */
    protected $id;
    /**
     * @MongoDB\Field(type="int")
     */
    protected $requestId;
    /**
     * @MongoDB\Field(type="int")
     */
    protected $number;
    /**
     * @MongoDB\Field(type="string")
     */

    protected $date_of_payment;
    /**
     * @MongoDB\Field(type="float")
     */
    protected $rest_amount;
    /**
     * @MongoDB\Field(type="float")
     */
    protected $percent;
    /**
     * @MongoDB\Field(type="float")
     */
    protected $payment;
    /**
     * @MongoDB\Field(type="float")
     */
    protected $main_payment;
    /**
     * @MongoDB\Field(type="float")
     */
    protected $percentage_payment;

    /**
     * @return mixed
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * @param mixed $requestId
     */
    public function setRequestId($requestId)
    {
        $this->requestId = $requestId;
    }

    /**
     * @return mixed
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getDateOfPayment()
    {
        return $this->date_of_payment;
    }

    /**
     * @param mixed $date_of_payment
     */
    public function setDateOfPayment($date_of_payment)
    {
        $this->date_of_payment = $date_of_payment;
    }

    /**
     * @return mixed
     */
    public function getRestAmount()
    {
        return $this->rest_amount;
    }

    /**
     * @param mixed $rest_amount
     */
    public function setRestAmount($rest_amount)
    {
        $this->rest_amount = number_format($rest_amount,2);
    }

    /**
     * @return mixed
     */
    public function getPercent()
    {
        return $this->percent;
    }

    /**
     * @param mixed $percent
     */
    public function setPercent($percent)
    {
        $this->percent = $percent;
    }

    /**
     * @return mixed
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @param mixed $payment
     */
    public function setPayment($payment)
    {
        $this->payment = number_format($payment,2);
    }

    /**
     * @return mixed
     */
    public function getMainPayment()
    {
        return $this->main_payment;
    }

    /**
     * @param mixed $main_payment
     */
    public function setMainPayment($main_payment)
    {
        $this->main_payment = number_format($main_payment,2);
    }

    /**
     * @return mixed
     */
    public function getPercentagePayment()
    {
        return $this->percentage_payment;
    }

    /**
     * @param mixed $percentage_payment
     */
    public function setPercentagePayment($percentage_payment)
    {
        $this->percentage_payment = number_format($percentage_payment,2);
    }




}