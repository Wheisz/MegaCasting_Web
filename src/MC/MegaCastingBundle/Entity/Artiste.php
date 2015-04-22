<?php

namespace MC\MegaCastingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Artiste
 *
 * @ORM\Table(name="Artiste", indexes={@ORM\Index(name="IFK_Artiste_Sexe", columns={"Sexe_id"}), @ORM\Index(name="IFK_Artiste_Utilisateur", columns={"Utilisateur_id"}), @ORM\Index(name="IFK_Artiste_CaracPhysique", columns={"CaracteristiquePhysique_id"})})
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
     *   @ORM\JoinColumn(name="Sexe_id", referencedColumnName="Id")
     * })
     */
    private $sexe;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Utilisateur_id", referencedColumnName="Id")
     * })
     */
    private $utilisateur;

    /**
     * @var \Caracteristiquephysique
     *
     * @ORM\ManyToOne(targetEntity="Caracteristiquephysique")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="CaracteristiquePhysique_id", referencedColumnName="Id")
     * })
     */
    private $caracteristiquephysique;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Metier", inversedBy="artiste")
     * @ORM\JoinTable(name="artiste_metier",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Artiste_id", referencedColumnName="Id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Metier_id", referencedColumnName="Id")
     *   }
     * )
     */
    private $metier;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->metier = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set sexe
     *
     * @param \MC\MegaCastingBundle\Entity\Sexe $sexe
     * @return Artiste
     */
    public function setSexe(\MC\MegaCastingBundle\Entity\Sexe $sexe = null)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return \MC\MegaCastingBundle\Entity\Sexe 
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set utilisateur
     *
     * @param \MC\MegaCastingBundle\Entity\Utilisateur $utilisateur
     * @return Artiste
     */
    public function setUtilisateur(\MC\MegaCastingBundle\Entity\Utilisateur $utilisateur = null)
    {
        $this->utilisateur = $utilisateur;

        return $this;
    }

    /**
     * Get utilisateur
     *
     * @return \MC\MegaCastingBundle\Entity\Utilisateur 
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }

    /**
     * Set caracteristiquephysique
     *
     * @param \MC\MegaCastingBundle\Entity\Caracteristiquephysique $caracteristiquephysique
     * @return Artiste
     */
    public function setCaracteristiquephysique(\MC\MegaCastingBundle\Entity\Caracteristiquephysique $caracteristiquephysique = null)
    {
        $this->caracteristiquephysique = $caracteristiquephysique;

        return $this;
    }

    /**
     * Get caracteristiquephysique
     *
     * @return \MC\MegaCastingBundle\Entity\Caracteristiquephysique 
     */
    public function getCaracteristiquephysique()
    {
        return $this->caracteristiquephysique;
    }

    /**
     * Add metier
     *
     * @param \MC\MegaCastingBundle\Entity\Metier $metier
     * @return Artiste
     */
    public function addMetier(\MC\MegaCastingBundle\Entity\Metier $metier)
    {
        $this->metier[] = $metier;

        return $this;
    }

    /**
     * Remove metier
     *
     * @param \MC\MegaCastingBundle\Entity\Metier $metier
     */
    public function removeMetier(\MC\MegaCastingBundle\Entity\Metier $metier)
    {
        $this->metier->removeElement($metier);
    }

    /**
     * Get metier
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMetier()
    {
        return $this->metier;
    }
}
