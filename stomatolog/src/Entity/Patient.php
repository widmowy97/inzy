<?php


namespace App\Entity;


use App\Partial\IdAwareInterface;
use App\Partial\IdAwareTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Patient
 * @package App\Entity
 * @ORM\Entity()
 */
class Patient extends User
{

/**
 * @ORM\Column(type="string")
 * @var string
 */
protected $FirstName;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $LastName;



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
    public function __toString(): string
    {
        return $this->FirstName . ' ' . $this->LastName;
    }

    public function persist(Patient $patient)
    {
    }


}