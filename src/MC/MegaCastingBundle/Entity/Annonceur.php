<?php

namespace MC\MegaCastingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Annonceur
 *
 * @ORM\Table(name="Annonceur")
 * @ORM\Entity
 */
class Annonceur
{
    /**
     * @var \Societe
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Societe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id", referencedColumnName="Id")
     * })
     */
    private $id;



    /**
     * Set id
     *
     * @param \MC\MegaCastingBundle\Entity\Societe $id
     * @return Annonceur
     */
    public function setId(\MC\MegaCastingBundle\Entity\Societe $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return \MC\MegaCastingBundle\Entity\Societe 
     */
    public function getId()
    {
        return $this->id;
    }
}
