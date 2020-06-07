<?php

namespace App\Controller\Project;

use App\Entity\Project;
use Symfony\Component\Security\Core\Security;

class PostProjectController
{
    private $user;

    public function __construct(Security $security)
    {
        $this->user = $security->getUser();
    }

    public function __invoke(Project $data): Project
    {
        if (!$this->user) {
            return false;
        }
        $data->setAuthor($this->user);
        return $data;
    }
}
