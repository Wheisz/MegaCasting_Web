<?php

namespace MC\MegaCastingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Metier
 *
 * @ORM\Table(name="Metier", uniqueConstraints={@ORM\UniqueConstraint(name="UK_Metier", columns={"Libelle"})}, indexes={@ORM\Index(name="IDX_560C08BAD2FFF4F", columns={"Domaine_id"})})
 * @ORM\Entity
 */
class Metier
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
     * @var \Domaine
     *
     * @ORM\ManyToOne(targetEntity="Domaine", inversedBy="metiers")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Domaine_id", referencedColumnName="Id")
     * })
     */
    private $domaine;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Artiste", mappedBy="metier")
     */
    private $artiste;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->artiste = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * Set libelle
     *
     * @param string $libelle
     * @return Metier
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
     * Set domaine
     *
     * @param \MC\MegaCastingBundle\Entity\Domaine $domaine
     * @return Metier
     */
    public function setDomaine(\MC\MegaCastingBundle\Entity\Domaine $domaine = null)
    {
        $this->domaine = $domaine;

        return $this;
    }

    /**
     * Get domaine
     *
     * @return \MC\MegaCastingBundle\Entity\Domaine 
     */
    public function getDomaine()
    {
        return $this->domaine;
    }

    /**
     * Add artiste
     *
     * @param \MC\MegaCastingBundle\Entity\Artiste $artiste
     * @return Metier
     */
    public function addArtiste(\MC\MegaCastingBundle\Entity\Artiste $artiste)
    {
        $this->artiste[] = $artiste;

        return $this;
    }

    /**
     * Remove artiste
     *
     * @param \MC\MegaCastingBundle\Entity\Artiste $artiste
     */
    public function removeArtiste(\MC\MegaCastingBundle\Entity\Artiste $artiste)
    {
        $this->artiste->removeElement($artiste);
    }

    /**
     * Get artiste
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArtiste()
    {
        return $this->artiste;
    }
}
