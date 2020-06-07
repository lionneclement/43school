<?php

namespace App\Entity;

use App\Controller\Student\PostStudentController;
use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 * @ApiResource(
 *      collectionOperations={
 *              "get",
 *              "post"={
 *                  "controller"=PostStudentController::class
 *              }
 *          },
 *      itemOperations={
 *              "get",
 *              "put",
 *              "delete"
 *          }
 * )
 */
class Student
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateFinish;

    /**
     * @ORM\ManyToOne(targetEntity=Project::class, inversedBy="students")
     */
    private $project;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="students")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateFinish(): ?\DateTimeInterface
    {
        return $this->dateFinish;
    }

    public function setDateFinish(\DateTimeInterface $dateFinish): self
    {
        $this->dateFinish = $dateFinish;

        return $this;
    }

    public function getProject(): ?project
    {
        return $this->project;
    }

    public function setProject(?project $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }
}
