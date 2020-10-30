<?php

namespace App\Entity;


use App\Partial\IdAwareInterface;
use App\Partial\IdAwareTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Description
 * @package App\Entity
 * @ORM\Entity()
 */
class Description
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     */
    private $content;


    /**
     *@ORM\ManyToOne(targetEntity="App\Entity\Visit", inversedBy="description")
     * @ORM\JoinColumn(nullable=false)
     */
    private $visit;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }


    /**
     * @return mixed
     */
    public function getVisit()
    {
        return $this->visit;
    }

    /**
     * @param mixed $visit
     */
    public function setVisit($visit): void
    {
        $this->visit = $visit;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    

}

