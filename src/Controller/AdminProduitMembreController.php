<?php
namespace App\Controller;

use App\Entity\ProduitMembre;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use Symfony\Component\HttpFoundation\RedirectResponse;


class AdminProduitMembreController extends BaseAdminController
{

    protected function createEntityFormBuilder($entity, $view){
        $editForm = parent::createEntityFormBuilder($entity, $view);
        return $editForm;
    }

    /**
     * @param ProduitMembre $entity
     * @return RedirectResponse
     * @throws \LogicException
     */
    protected function prePersistEntity($entity)
    {
        return $this->saveEntity($entity);
    }

    /**
     * @param ProduitMembre $entity
     * @return RedirectResponse
     * @throws \LogicException
     */
    protected function preUpdateEntity($entity)
    {
        return $this->saveEntity($entity);
    }

    /**
     *
     * @param ProduitMembre $entity
     * @return RedirectResponse
     * @throws \LogicException
     */
    private function saveEntity($entity)
    {
        if ($entity){
            $dateFinVente = new \Datetime();
            $dateFinVente->add(new \DateInterval('P2D'));
            $entity->setDateFinVente($dateFinVente);
            $entity->setPrixventes(14);
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

