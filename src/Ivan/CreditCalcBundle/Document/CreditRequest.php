<?php
/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 03.12.17
 * Time: 15:38
 */
namespace Ivan\CreditCalcBundle\Document;
use DateTime;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
/**
 * @MongoDB\Document
 */

class CreditRequest
{

    /**
    * @MongoDB\Id
    */
    protected $id;
    /**
     * @Assert\Range(
     *     min = 0,
     *     minMessage = "сумма должна быть положительной")
     *
     *  @MongoDB\Field(type="int")
     */
  protected $amount;

    /**
     * @Assert\Range(
     *     min = 0,
     *     minMessage = "период должен быть положительным"
     * )
     * @MongoDB\Field(type="int")
     */

  protected $period;

    /**
     * @Assert\Range(
     *     min = 0,
     *     max = 100,
     *     minMessage = "процентная ставка от 0 до 100",
     *     maxMessage = "процентная ставка от 0 до 100"
     * )
     * @MongoDB\Field(type="float")
     */

  protected $percentage;

    /**
     * @Assert\Range(
     *     min = "now",
     *     minMessage = "Дата не может быть в прошлом"
     * )
     *
     */

  protected $first_payment_date;

    /**
     * @MongoDB\Field(type="string")
     */

    protected $first_payment_date_str_val;
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }



    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @param mixed $period
     */
    public function setPeriod($period)
    {
        $this->period = ceil($period);
    }

    /**
     * @return mixed
     */
    public function getPercentage()
    {
        return $this->percentage;
    }

    /**
     * @param mixed $percentage
     */
    public function setPercentage($percentage)
    {
        $this->percentage = $percentage;
    }

    /**
     * @return mixed
     */
    public function getFirstPaymentDate()
    {
        if(!$this->first_payment_date){
            $this->first_payment_date = new DateTime($this->first_payment_date_str_val);
        }
        return $this->first_payment_date;
    }

    /**
     * @param DateTime $ferst_payment_date
     */
    public function setFirstPaymentDate($first_payment_date)
    {
        $this->first_payment_date = $first_payment_date;
        $this->first_payment_date_str_val = $first_payment_date->format('Y-m-d');
    }

    /**
     * @param $formData
     * @return CreditRequest
     */
    public static function fromArray($formData){

        $cr = new CreditRequest();
        $cr->setAmount($formData['amount']);
        $cr->setPeriod($formData['period']);
        $cr->setFirstPaymentDate(new DateTime($formData['first_payment_date']));
        $cr->setPercentage($formData['percentage']);
        return $cr;

    }

}