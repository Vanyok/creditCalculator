<?php

namespace Ivan\CreditCalcBundle\Service;
use DateInterval;
use DateTime;
use Doctrine\ODM\MongoDB\DocumentManager;
use Ivan\CreditCalcBundle\Document\CreditCalculation;
use Ivan\CreditCalcBundle\Document\CreditRequest;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Created by PhpStorm.
 * User: ivan
 * Date: 03.12.17
 * Time: 18:36
 */

class CreditCalculator
{

    /**
     * @var ContainerInterface
     */
    private $documentManager;

    /**
     *
     * @param ContainerInterface $container
     */
    public function __construct(DocumentManager $documentManager)
    {
        $this->documentManager = $documentManager;
    }
    /**
     * @param CreditRequest $creditRequest
     */
    public function proceedCreditRequest($creditRequest){

        $date = $creditRequest->getFirstPaymentDate();
        $rest = $creditRequest->getAmount();
        $percent = $creditRequest->getPercentage();
        $i=0;
        $pay = $this->calculatePaymentPerMonth($rest,$percent,$creditRequest->getPeriod());
        $payments = array();
        $requestId = $this->saveRequest($creditRequest);
        while ($rest > 0){
            $i++;
            $payment = new CreditCalculation();
            $payment->setNumber($i);
            $payment->setRequestId($requestId   );
            $payment->setDateOfPayment($date->format('Y-m-d'));
            $payment->setPayment($pay);
            $percPayment = $this->calculatePercentagePayment($rest,$percent);
            $payment->setPercentagePayment($percPayment);
            $mainPayment = $pay - $percPayment;
            $payment->setMainPayment( $mainPayment);
            $rest -= $mainPayment;
            $payment->setRestAmount($rest);
            $payments[]=$payment;
            $this->saveCalculation($payment);
            $date = $date->add($this->add_months(1, $date));
        }
       return $payments;
    }

    public function getHeaders(){
        return [
            'number'=>'№',
            'dateOfPayment'=>'Дата платежа',
            'percentagePayment'=>'Проценты',
            'mainPayment'=>'Основной платеж',
            'payment'=>'Всего за платеж',
            'restAmount'=>'Остаток кредита'
        ];
    }


    public function calculatePaymentPerMonth($amount,$percentage,$period){
        $p = $percentage/(12*100);
        $x = $amount*($p+$p/(pow(1+$p,$period)-1));
        return $x;
    }

    public function calculatePercentagePayment($amount,$percentage){
        return $amount* $percentage/(12*100);
    }

    public function add_months($months, DateTime $dateObject)
    {
        $next = new DateTime($dateObject->format('Y-m-d'));
        $next->modify('last day of +'.$months.' month');

        if($dateObject->format('d') > $next->format('d')) {
            return $dateObject->diff($next);
        } else {
            return new DateInterval('P'.$months.'M');
        }
    }

    public function saveRequest($request){
         $this->documentManager->persist($request);
        $this->documentManager->flush();
        return $request->getId();
    }

    public function saveCalculation($calculation){
        $this->documentManager->persist($calculation);
        $this->documentManager->flush();

    }

}