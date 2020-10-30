<?php


namespace App\Entity;

use App\Partial\IdAwareInterface;
use App\Partial\IdAwareTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\ORM\PersistentCollection;

// use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class Visit
 * @package App\Entity
 * @ORM\Entity()
 * @ORM\Table(
 * uniqueConstraints={
 *     @UniqueConstraint(
 *         name="one_visit_per_patient_key",
 *         columns={"start_date", "dentist_id"}
 *     )
 * }
 * )
 * UniqueEntity(fields={"StartDate",  "dentist",}, message="Proszę wybrać inny termin wizyty")
 */

class Visit implements IdAwareInterface
{
 use IdAwareTrait;

 /**
  * @ORM\Column(type="datetime")
  * @var \DateTime
  */
 private $StartDate;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $EndDate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Description", mappedBy="visit")
     * @ORM\JoinColumn(nullable=false)
     */
    private $descriptions;

    public function __construct()
    {
        $this->contents = new ArrayCollection();
    }

    /**
     *@ORM\ManyToOne(targetEntity="App\Entity\Patient")
     * @var Patient
     */
    private $patient;

    /**
     *@ORM\ManyToOne(targetEntity="App\Entity\Dentist")
     * @var Dentist
     */
    private $dentist;


    /**
     * @return \DateTime
     */
    public function getStartDate(): ?\DateTime
    {
        return $this->StartDate;
    }

    /**
     * @param \DateTime $StartDate
     */
    public function setStartDate(\DateTime $StartDate): void
    {
        $this->StartDate = $StartDate;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate(): ?\DateTime
    {
        return $this->EndDate;
    }

    /**
     * @param \DateTime $EndDate
     */
    public function setEndDate(\DateTime $EndDate): void
    {
        $this->EndDate = $EndDate;
    }

    /**
     * @return Dentist
     */
    public function getDentist(): ?Dentist
    {
        return $this->dentist;
    }

    /**
     * @param Dentist $dentist
     */
    public function setDentist(Dentist $dentist): void
    {
        $this->dentist = $dentist;
    }

    /**
     * @return Patient
     */
    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    /**
     * @param Patient $patient
     */
    public function setPatient(Patient $patient): void
    {
        $this->patient = $patient;
    }


    public function __toString()
    {
        return $this->StartDate->format('Y-m-d h:i') . ' '
            . $this->EndDate->format('Y-m-d h:i') . ' '
            . $this->patient->__toString();
    }

    /**
     * @return Collection\Descriptions[]
     */
    public function getDescriptions():PersistentCollection
    {
        return $this->descriptions;
    }

    public function addDescription(Description $content): self
    {
        if (!$this->descriptions->contains($content)) {
            $this->descriptions[] =$content;
            $content->setVisit($this);
        }
        return $this;
    }

    public function  removeDescription(Description $content): self
    {
        if ($this->descriptions->contains($content)) {
            $this->descriptions->removeElement($content);
            if ($content->getVisit() == $this) {
                $content->setDescriptions(null);
            }
        }

        return $this;
    }



}
