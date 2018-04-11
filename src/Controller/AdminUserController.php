<?php
namespace App\Controller;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use Symfony\Component\HttpFoundation\RedirectResponse;


class AdminUserController extends BaseAdminController
{

    protected function createEntityFormBuilder($entity, $view){
        $editForm = parent::createEntityFormBuilder($entity, $view);
        return $editForm;
    }

    /**
     * @param User $entity
     * @return RedirectResponse
     * @throws \LogicException
     */
    protected function prePersistEntity($entity)
    {
        return $this->saveEntity($entity);
    }

    /**
     * @param User $entity
     * @return RedirectResponse
     * @throws \LogicException
     */
    protected function preUpdateEntity($entity)
    {
        return $this->saveEntity($entity);
    }

    /**
     *
     * @param User $entity
     * @return RedirectResponse
     * @throws \LogicException
     */
    private function saveEntity($entity)
    {
    }
}