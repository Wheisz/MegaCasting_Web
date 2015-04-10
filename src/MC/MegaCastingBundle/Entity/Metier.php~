<?php

namespace MC\MegaCastingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Metier
 *
 * @ORM\Table(name="Metier", uniqueConstraints={@ORM\UniqueConstraint(name="UK_Metier", columns={"Libelle"})}, indexes={@ORM\Index(name="IDX_560C08BAEAE7E39D", columns={"IdDomaine"})})
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
     * @ORM\ManyToOne(targetEntity="Domaine")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdDomaine", referencedColumnName="Id")
     * })
     */
    private $iddomaine;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Artiste", mappedBy="idmetier")
     */
    private $idartiste;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idartiste = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set iddomaine
     *
     * @param \MC\MegaCastingBundle\Entity\Domaine $iddomaine
     * @return Metier
     */
    public function setIddomaine(\MC\MegaCastingBundle\Entity\Domaine $iddomaine = null)
    {
        $this->iddomaine = $iddomaine;

        return $this;
    }

    /**
     * Get iddomaine
     *
     * @return \MC\MegaCastingBundle\Entity\Domaine 
     */
    public function getIddomaine()
    {
        return $this->iddomaine;
    }

    /**
     * Add idartiste
     *
     * @param \MC\MegaCastingBundle\Entity\Artiste $idartiste
     * @return Metier
     */
    public function addIdartiste(\MC\MegaCastingBundle\Entity\Artiste $idartiste)
    {
        $this->idartiste[] = $idartiste;

        return $this;
    }

    /**
     * Remove idartiste
     *
     * @param \MC\MegaCastingBundle\Entity\Artiste $idartiste
     */
    public function removeIdartiste(\MC\MegaCastingBundle\Entity\Artiste $idartiste)
    {
        $this->idartiste->removeElement($idartiste);
    }

    /**
     * Get idartiste
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdartiste()
    {
        return $this->idartiste;
    }
}
