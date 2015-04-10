<?php

namespace MC\MegaCastingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Artiste
 *
 * @ORM\Table(name="Artiste", indexes={@ORM\Index(name="IFK_Artiste_Sexe", columns={"IdSexe"}), @ORM\Index(name="IFK_Artiste_Utilisateur", columns={"IdUtilisateur"}), @ORM\Index(name="IFK_Artiste_CaracPhysique", columns={"IdCaracteristiquePhysique"})})
 * @ORM\Entity
 */
class Artiste
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
     * @var \DateTime
     *
     * @ORM\Column(name="DateNaissance", type="datetime", nullable=false)
     */
    private $datenaissance;

    /**
     * @var \Sexe
     *
     * @ORM\ManyToOne(targetEntity="Sexe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdSexe", referencedColumnName="Id")
     * })
     */
    private $idsexe;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdUtilisateur", referencedColumnName="id")
     * })
     */
    private $idutilisateur;

    /**
     * @var \Caracteristiquephysique
     *
     * @ORM\ManyToOne(targetEntity="Caracteristiquephysique")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdCaracteristiquePhysique", referencedColumnName="Id")
     * })
     */
    private $idcaracteristiquephysique;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Metier", inversedBy="idartiste")
     * @ORM\JoinTable(name="artiste_metier",
     *   joinColumns={
     *     @ORM\JoinColumn(name="IdArtiste", referencedColumnName="Id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="IdMetier", referencedColumnName="Id")
     *   }
     * )
     */
    private $idmetier;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idmetier = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set datenaissance
     *
     * @param \DateTime $datenaissance
     * @return Artiste
     */
    public function setDatenaissance($datenaissance)
    {
        $this->datenaissance = $datenaissance;

        return $this;
    }

    /**
     * Get datenaissance
     *
     * @return \DateTime 
     */
    public function getDatenaissance()
    {
        return $this->datenaissance;
    }

    /**
     * Set idsexe
     *
     * @param \MC\MegaCastingBundle\Entity\Sexe $idsexe
     * @return Artiste
     */
    public function setIdsexe(\MC\MegaCastingBundle\Entity\Sexe $idsexe = null)
    {
        $this->idsexe = $idsexe;

        return $this;
    }

    /**
     * Get idsexe
     *
     * @return \MC\MegaCastingBundle\Entity\Sexe 
     */
    public function getIdsexe()
    {
        return $this->idsexe;
    }

    /**
     * Set idutilisateur
     *
     * @param \MC\MegaCastingBundle\Entity\Utilisateur $idutilisateur
     * @return Artiste
     */
    public function setIdutilisateur(\MC\MegaCastingBundle\Entity\Utilisateur $idutilisateur = null)
    {
        $this->idutilisateur = $idutilisateur;

        return $this;
    }

    /**
     * Get idutilisateur
     *
     * @return \MC\MegaCastingBundle\Entity\Utilisateur 
     */
    public function getIdutilisateur()
    {
        return $this->idutilisateur;
    }

    /**
     * Set idcaracteristiquephysique
     *
     * @param \MC\MegaCastingBundle\Entity\Caracteristiquephysique $idcaracteristiquephysique
     * @return Artiste
     */
    public function setIdcaracteristiquephysique(\MC\MegaCastingBundle\Entity\Caracteristiquephysique $idcaracteristiquephysique = null)
    {
        $this->idcaracteristiquephysique = $idcaracteristiquephysique;

        return $this;
    }

    /**
     * Get idcaracteristiquephysique
     *
     * @return \MC\MegaCastingBundle\Entity\Caracteristiquephysique 
     */
    public function getIdcaracteristiquephysique()
    {
        return $this->idcaracteristiquephysique;
    }

    /**
     * Add idmetier
     *
     * @param \MC\MegaCastingBundle\Entity\Metier $idmetier
     * @return Artiste
     */
    public function addIdmetier(\MC\MegaCastingBundle\Entity\Metier $idmetier)
    {
        $this->idmetier[] = $idmetier;

        return $this;
    }

    /**
     * Remove idmetier
     *
     * @param \MC\MegaCastingBundle\Entity\Metier $idmetier
     */
    public function removeIdmetier(\MC\MegaCastingBundle\Entity\Metier $idmetier)
    {
        $this->idmetier->removeElement($idmetier);
    }

    /**
     * Get idmetier
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getIdmetier()
    {
        return $this->idmetier;
    }
}
