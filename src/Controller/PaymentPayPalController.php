<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Entity\PaymentPayPal;
use App\Entity\TransactionFactory;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Api\Payment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentPayPalController extends Controller
{
    /**
     * * @param Request $request
     * @return Response
     * @Route("/payment/test", name="payment_paypal")
     */
    public function payment(Request $request){
        $panier = $this->getPanier($request);
        $apiContext = (new PaymentPayPal())
            ->getApiContext();


        //on genere le payment
        $payement = new Payment();
        $payement->addTransaction(TransactionFactory::fromPanier($panier));
        $payement->setIntent('sale'); // defini que c'est une vente, ca pourais etre un ordre de payement ou une commande
        $returnUrl = $request->getSchemeAndHttpHost().$this->generateUrl('payment_paypal_pay');
        $cancelUrl = $request->getSchemeAndHttpHost().$this->generateUrl('panier');
        $redirectUrls = (new RedirectUrls()) //defini les route si validé ou annulé
            ->setReturnUrl($returnUrl)
            ->setCancelUrl($cancelUrl);
        $payement->setRedirectUrls($redirectUrls);
        // Ensuite on defini le payer on utilise l'interface de paypal on pourais renvoyer les information cb..
        $payement->setPayer((new Payer())->setPaymentMethod('paypal'));

        try{
            $payement->create($apiContext);
            return $this->redirect($payement->getApprovalLink(), 308);
        }catch (PayPalConnectionException $e){
            dump(json_decode($e->getData()));
        }

        return $this->render('payement_test.html.twig');
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/payment/test/pay", name="payment_paypal_pay")
     */
    public function pay(Request $request){
        //vérifier le retour si il corespond bien au panier
        $apiContext = (new PaymentPayPal())
            ->getApiContext();
        $panier = $this->getPanier($request);
        $payment = Payment::get($_GET['paymentId'], $apiContext);

        $execution = (new PaymentExecution())
            ->setPayerId($_GET['PayerID'])
            ->addTransaction(TransactionFactory::fromPanier($panier, 0.2));
            /*->addTransactions(TransactionFactory::fromPanier($panier, 0.2));
             Si une taxe pour un autre pays est neccessaire(pays visible dans la reponse Paypal),
            plutot que de get la transaction générer une nouvelle avec le taux a appliquer*/

        try{
            $payment->execute($execution, $apiContext);
            dump($payment);
        }catch (PayPalConnectionException $e){
            dump(json_decode($e->getData()));
        }
        return $this->render('payement_test_pay.html.twig');

    }

    public function getPanier(Request $request){
        $em = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $panier = new Panier($em);
        $arrayPanier = $session->get('panier');
        $panier->setPanier($arrayPanier);
        return $panier;
    }

}
