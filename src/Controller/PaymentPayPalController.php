<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\DeliveryAdressUser;
use App\Entity\LigneCommande;
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

            return $this->json(array('id' => $payement->getId()));

        }catch (PayPalConnectionException $e){
            return $this->json($e->getData());
        }
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
        $payment = Payment::get($_POST['paymentID'], $apiContext);

        $execution = (new PaymentExecution())
            ->setPayerId($_POST['payerID'])
            ->setTransactions($payment->getTransactions());
            /*->addTransactions(TransactionFactory::fromPanier($panier, 0.2));
             Si une taxe pour un autre pays est neccessaire(pays visible dans la reponse Paypal),
            plutot que de get la transaction générer une nouvelle avec le taux a appliquer*/

        try{
            $payment->execute($execution, $apiContext);
            return $this->paymentStatus($request, $payment, $panier);
        }catch (PayPalConnectionException $e){
            return $this->redirectToRoute('payment_paypal_pay_fail');
        }
    }

    public function paymentStatus(Request $request,Payment $payment, Panier $panier) {
        if ($payment->getState() == "approved"){
            $user = $this->getUser();
            $trans = $payment->getTransactions();
            $relatedRessource = $trans[0]->getRelatedResources();
            $idSale = $relatedRessource[0]->getSale()->getId();
            $idCommande = $panier->addCommande($user, $idSale);
            $session = $request->getSession();
            $session->set('idCommande', $idCommande );
            return $this->redirectToRoute('payment_paypal_pay_success');
        }
        return $this->redirectToRoute('payment_paypal_pay_fail');
    }

    /**
     * @param Request $request
     * @return Response
     * @Route("/payment/test/pay/success", name="payment_paypal_pay_success")
     */
    public function paySuccess(Request $request){
        $session = $request->getSession();
        $user = $this->getUser();
        $idCommande = $session->get("idCommande");
        $commande =  $this->getDoctrine()
            ->getRepository(Commande::class)
            ->find($idCommande);
        $lignesCommande =  $this->getDoctrine()
            ->getRepository(LigneCommande::class)
            ->findBy(
                array('commande' => $commande->getId())
            );
        $adresseId = $session->get('adresseLivraison');
        if ($adresseId == 0){
            $adresse = $user->getCompletAdress();
        }else{
            $adresse = $this->getDoctrine()
                ->getRepository(DeliveryAdressUser::class)
                ->find($adresseId);
        }

        dump($adresse);
        return $this->render('payment_success.html.twig', array(
        ));
    }

    /**
     * @return Response
     * @Route("/payment/test/pay/fail", name="payment_paypal_pay_fail")
     */
    public function payFail(){
        $this->addFlash('Paypal', "La transaction à rencontré un probleme. veuillez tenter de nouveau");
        return $this->redirectToRoute('panier');
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
