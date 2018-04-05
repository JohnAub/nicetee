<?php

namespace App\Controller;

use App\Entity\PaymentPayPal;
use PayPal\Api\RedirectUrls;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Api\Payment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PaymentPayPalController extends Controller
{
    /**
 * @Route("/payment/test", name="payment_paypal")
 */
    public function payment(){
        $payementPaypal = new PaymentPayPal();
        $ids = $payementPaypal->getId();
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                $ids['id'],
                $ids['secret']
            )
        );
        $payement = new Payment();
        $payement->setIntent('sale'); // defini que c'est une vente, ca pourais etre un ordre de payement ou une commande
        $redirectUrls = (new RedirectUrls()) //defini les route si validé ou annulé
            ->setReturnUrl($this->generateUrl('payment_paypal_pay'))
            ->setCancelUrl($this->generateUrl('panier'));
        $payement->setRedirectUrls($redirectUrls);
        $payement->create($apiContext);
        echo $payement->getApprovalLink();

        return $this->render('payement_test.html.twig');
    }

    /**
     * @Route("/payment/test/pay", name="payment_paypal_pay")
     */
    public function pay(){

        return $this->render('payement_test_pay.html.twig');
    }

}
