<?php

namespace App\Entity;


use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Transaction;

class TransactionFactory
{
    static function fromPanier(Panier $panier, float $vatRate = 0): Transaction{
        //on defini la transaction
        $list = new ItemList(); //La liste des produits
        foreach ($panier->getProducts() as $product){
            $item = (new Item())
                ->setName($product['designation'])
                ->setPrice($product['prixUnitaire'])
                ->setCurrency('EUR')
                ->setQuantity($product['qty']);
            $list->addItem($item);
        }

        //Le total avec les detail (tva etc...)
        $details = (new Details())
            ->setTax($panier->getVatPrice($vatRate))
            ->setSubtotal($panier->getPrice());
        $amount = (new Amount())
            ->setTotal($panier->getPrice() + $panier->getVatPrice($vatRate))
            ->setCurrency('EUR')
            ->setDetails($details);

        //On cree la transaction et on la retourne
        return (new Transaction())
            ->setItemList($list)
            ->setDescription('Achat sur NiceTee.fr')
            ->setAmount($amount)
            ->setCustom('test-1');
    }
}