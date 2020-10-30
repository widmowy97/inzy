<?php


namespace App\Entity;


use App\Partial\IdAwareInterface;
use App\Partial\IdAwareTrait;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Dentist
 * @package App\Entity
 * @ORM\Entity()
 */
class Dentist extends User
{

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $FirstName;
    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $LastName;


    /**
     * @return string
     */
    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    /**
     * @param string $LastName
     */
    public function setLastName(string $LastName): void
    {
        $this->LastName = $LastName;
    }



    /**
     * @param Specialization $specialization
     */
    public function setSpecialization(Specialization $specialization): void
    {
        $this->specialization = $specialization;
    }
    public function __toString(): string
    {
        return $this->FirstName . ' ' . $this->LastName;
    }

    /**
     * @return string
     */
    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    /**
     * @param string $FirstName
     */
    public function setFirstName(string $FirstName): void
    {
        $this->FirstName = $FirstName;
    }

    public function persist(Dentist $dentist)
    {
    }

}