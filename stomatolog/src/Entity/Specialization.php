<?php


namespace App\Entity;


use App\Partial\IdAwareInterface;
use App\Partial\IdAwareTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Specialization
 * @package App\Entity
 * @ORM\Entity()
 */
class Specialization implements IdAwareInterface
{
use IdAwareTrait;

    /**
     * @ORM\Column(type="string")
     * @var string
     */
    private $Name;

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->Name;
    }

    /**
     * @param string $Name
     */
    public function setName(string $Name): void
    {
        $this->Name = $Name;
    }
    public function __toString(): string
    {
        return $this->Name;
    }


}