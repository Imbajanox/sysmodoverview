<?php
namespace WirklichDigital\SyshelperFrontend\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Doctrine\ORM\EntityManager;

class RedirectController extends AbstractActionController
{
    /** @var EntityManager */
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }

    public function indexAction()
    {
        /** @var User $identity */
        $identity = $this->identity();
        if (! $identity) {
            return $this->redirect()->toRoute('authentication/login');
        }
        
        return $this->redirect()->toRoute('syshelper-frontend/dashboard');
    }
}
