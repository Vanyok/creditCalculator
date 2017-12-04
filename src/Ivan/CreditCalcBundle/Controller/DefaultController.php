<?php

namespace Ivan\CreditCalcBundle\Controller;

use Ivan\CreditCalcBundle\Document\CreditRequest;
use Ivan\CreditCalcBundle\Form\CreditRequestForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {

        $cRequest = new CreditRequest();
        $form = $this->createForm(CreditRequestForm::class,$cRequest);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $cRequest = $form->getData();
            $calculator = $this->get('ivan_credit_calc.credit_calculator');
            $payments = $calculator->proceedCreditRequest($cRequest);
            $headers = $calculator->getHeaders();
            return $this->render('IvanCreditCalcBundle:Default:result.html.twig',array(
                'payments' => $payments,
                'headers' => $headers,
            ));
        }
        return $this->render('IvanCreditCalcBundle:Default:index.html.twig',array(
            'form' => $form->createView(),
        ));
    }
}

/**amount
period
percentage
ferst_payment_date
*/