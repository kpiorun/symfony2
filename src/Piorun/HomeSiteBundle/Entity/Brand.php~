<?php

namespace Piorun\HomeSiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Brand
 *
 * @ORM\Table(name="brand")
 * @ORM\Entity
 */
class Brand
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text", nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="partnercode", type="text", nullable=true)
     */
    private $partnercode;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creationdate", type="datetime", nullable=false)
     */
    private $creationdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getPartnercode()
    {
        return $this->partnercode;
    }
    public function setPartnercode($partnercode)
    {
        $this->partnercode = $partnercode;
    }
    public function getCreationdate(){
         return $this->creationdate;
    }
    public function setCreationdate(\DateTime $creationdate = null)
    {
        $this->creationdate = $creationdate;
    }
            

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
}
