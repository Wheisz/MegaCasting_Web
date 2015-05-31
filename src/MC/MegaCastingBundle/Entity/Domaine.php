<?php

namespace MC\MegaCastingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Domaine
 *
 * @ORM\Table(name="Domaine", uniqueConstraints={@ORM\UniqueConstraint(name="UK_Domaine", columns={"Libelle"})})
 * @ORM\Entity
 */
class Domaine
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Libelle", type="string", length=100, nullable=false)
     */
    private $libelle;

    /**
     * 
     * @ORM\OneToMany(
     *      targetEntity="Metier",
     *      mappedBy="domaine"
     * )
     */
    private $metiers;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return Domaine
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->metiers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add metiers
     *
     * @param \MC\MegaCastingBundle\Entity\Metier $metiers
     * @return Domaine
     */
    public function addMetier(\MC\MegaCastingBundle\Entity\Metier $metiers)
    {
        $this->metiers[] = $metiers;

        return $this;
    }

    /**
     * Remove metiers
     *
     * @param \MC\MegaCastingBundle\Entity\Metier $metiers
     */
    public function removeMetier(\MC\MegaCastingBundle\Entity\Metier $metiers)
    {
        $this->metiers->removeElement($metiers);
    }

    /**
     * Get metiers
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMetiers()
    {
        return $this->metiers;
    }
}
