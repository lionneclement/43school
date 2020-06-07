<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\Project\PostProjectController;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
/**
 * @ORM\Entity(repositoryClass=ProjectRepository::class)
 * @UniqueEntity("title")
 * @ApiResource(
 *      collectionOperations={
 *              "get",
 *              "post"={
 *                  "controller"=PostProjectController::class,
 *              }
 *          },
 *      itemOperations={
 *              "get",
 *              "put",
 *              "delete"
 *          }
 * )
 */
class Project
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $linkHelp = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $linkError = [];

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="projects")
     */
    private $author;

    /**
     * @ORM\ManyToMany(targetEntity=Course::class, mappedBy="project")
     */
    private $courses;

    /**
     * @ORM\OneToMany(targetEntity=Student::class, mappedBy="project")
     */
    private $students;

    public function __construct()
    {
        $this->courses = new ArrayCollection();
        $this->users = new ArrayCollection();
        $this->students = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getLinkHelp(): ?array
    {
        return $this->linkHelp;
    }

    public function setLinkHelp(?array $linkHelp): self
    {
        $this->linkHelp = $linkHelp;

        return $this;
    }

    public function getLinkError(): ?array
    {
        return $this->linkError;
    }

    public function setLinkError(?array $linkError): self
    {
        $this->linkError = $linkError;

        return $this;
    }

    public function getAuthor(): ?user
    {
        return $this->author;
    }

    public function setAuthor(?user $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection|Course[]
     */
    public function getCourses(): Collection
    {
        return $this->courses;
    }

    public function addCourse(Course $course): self
    {
        if (!$this->courses->contains($course)) {
            $this->courses[] = $course;
            $course->addProject($this);
        }

        return $this;
    }

    public function removeCourse(Course $course): self
    {
        if ($this->courses->contains($course)) {
            $this->courses->removeElement($course);
            $course->removeProject($this);
        }

        return $this;
    }

    /**
     * @return Collection|Student[]
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): self
    {
        if (!$this->students->contains($student)) {
            $this->students[] = $student;
            $student->setProject($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        if ($this->students->contains($student)) {
            $this->students->removeElement($student);
            // set the owning side to null (unless already changed)
            if ($student->getProject() === $this) {
                $student->setProject(null);
            }
        }

        return $this;
    }
}
