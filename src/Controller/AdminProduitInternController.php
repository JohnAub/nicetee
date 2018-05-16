<?php
namespace App\Controller;

use App\Entity\ProduitIntern;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use Symfony\Component\HttpFoundation\RedirectResponse;


class AdminProduitInternController extends BaseAdminController
{

    protected function createEntityFormBuilder($entity, $view){
        $editForm = parent::createEntityFormBuilder($entity, $view);
        return $editForm;
    }

    /**
     * @param ProduitIntern $entity
     * @return RedirectResponse
     * @throws \LogicException
     */
    protected function prePersistEntity($entity)
    {
        return $this->saveEntity($entity);
    }

    /**
     * @param ProduitIntern $entity
     * @return RedirectResponse
     * @throws \LogicException
     */
    protected function preUpdateEntity($entity)
    {
        return $this->saveEntity($entity);
    }

    /**
     *
     * @param ProduitIntern $entity
     * @return RedirectResponse
     * @throws \LogicException
     */
    private function saveEntity($entity)
    {

        if ($entity->getPrixAchat() && $entity->getTauxVente() && $entity->getTva()){
            $prixDeVente = $entity->getPrixAchat() * $entity->getTauxVente() * $entity->getTva();
            $entity->setPrixventes($prixDeVente);
        }
        if ($fournisseurUppercase = $this->request->query->get('entity')){
            $fournisseur = preg_replace('/(?=(?<!^)[[:upper:]])/', ' ', $fournisseurUppercase);
            $entity->setFournisseur($fournisseur);
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($entity);
        $em->flush();
        $this->addFlash('success', sprintf('Le Tee `%s` est sauvegardé', $entity->getDesignation()));
        return $this->redirectToRoute('easyadmin', [
            'action' => 'show',
            'entity' => $this->request->query->get('entity'),
        ]);
    }
}
