<?php
namespace App\Controller;

use App\Entity\Commande;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use Symfony\Component\HttpFoundation\RedirectResponse;


class AdminCommandeController extends BaseAdminController
{

    protected function createEntityFormBuilder($entity, $view){
        $editForm = parent::createEntityFormBuilder($entity, $view);
        return $editForm;
    }

    /**
     * @param Commande $entity
     * @return RedirectResponse
     * @throws \LogicException
     */
    protected function prePersistEntity($entity)
    {
        return $this->saveEntity($entity);
    }

    /**
     * @param Commande $entity
     * @return RedirectResponse
     * @throws \LogicException
     */
    protected function preUpdateEntity($entity)
    {
        return $this->saveEntity($entity);
    }

    /**
     *
     * @param Commande $entity
     * @return RedirectResponse
     * @throws \LogicException
     */
    private function saveEntity($entity)
    {
    }

    public function imprimerAction()
    {
        $id = $this->request->query->get('id');








        return $this->redirectToRoute('easyadmin', array(
            'action' => 'list',
            'entity' => $this->request->query->get('entity'),
        ));
    }

}

