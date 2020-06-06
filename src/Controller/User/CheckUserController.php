<?php

namespace App\Controller\User;

use App\Entity\User;
use Symfony\Component\Security\Core\Security;

class CheckUserController
{
    private $user;

    public function __construct(Security $security)
    {
        $this->user = $security->getUser();
    }

    public function __invoke(User $data): User
    {
         
        if (!$data instanceof $this->user) {
            return false;
        }

        return $data;
    }
}
