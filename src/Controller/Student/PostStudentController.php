<?php

namespace App\Controller\Student;

use App\Entity\Project;
use App\Entity\Student;
use Symfony\Component\Security\Core\Security;

class PostStudentController
{
    private $user;

    public function __construct(Security $security)
    {
        $this->user = $security->getUser();
    }

    public function __invoke(Student $data): Student
    {
        if (!$this->user) {
            return false;
        }
        $data->setDateFinish(new \DateTime());
        $data->setUser($this->user);

        return $data;
    }
}
