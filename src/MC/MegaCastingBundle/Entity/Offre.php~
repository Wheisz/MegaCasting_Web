<?php

namespace MC\MegaCastingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Offre
 *
 * @ORM\Table(name="Offre", uniqueConstraints={@ORM\UniqueConstraint(name="UK_Offre", columns={"Reference"})}, indexes={@ORM\Index(name="IFK_Offre_Domaine", columns={"IdDomaine"}), @ORM\Index(name="IFK_Offre_Metier", columns={"IdMetier"}), @ORM\Index(name="IFK_Offre_TypeContrat", columns={"IdTypeContrat"}), @ORM\Index(name="IFK_Offre_Annonceur", columns={"IdAnnonceur"})})
 * @ORM\Entity
 */
class Offre
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
     * @ORM\Column(name="Intitule", type="string", length=100, nullable=false)
     */
    private $intitule;

    /**
     * @var string
     *
     * @ORM\Column(name="Reference", type="string", length=100, nullable=false)
     */
    private $reference;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DatePublication", type="datetime", nullable=false)
     */
    private $datepublication;

    /**
     * @var integer
     *
     * @ORM\Column(name="DureeDiffusion", type="integer", nullable=false)
     */
    private $dureediffusion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DateDebutContrat", type="date", nullable=false)
     */
    private $datedebutcontrat;

    /**
     * @var integer
     *
     * @ORM\Column(name="NbPoste", type="integer", nullable=false)
     */
    private $nbposte;

    /**
     * @var string
     *
     * @ORM\Column(name="LocalisationLattitude", type="string", length=50, nullable=false)
     */
    private $localisationlattitude;

    /**
     * @var string
     *
     * @ORM\Column(name="LocalisationLongitude", type="string", length=50, nullable=false)
     */
    private $localisationlongitude;

    /**
     * @var string
     *
     * @ORM\Column(name="DescriptionPoste", type="string", length=0, nullable=false)
     */
    private $descriptionposte;

    /**
     * @var string
     *
     * @ORM\Column(name="DescriptionProfil", type="string", length=0, nullable=false)
     */
    private $descriptionprofil;

    /**
     * @var string
     *
     * @ORM\Column(name="Telephone", type="string", length=50, nullable=false)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=50, nullable=false)
     */
    private $email;

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
     * @var \Metier
     *
     * @ORM\ManyToOne(targetEntity="Metier")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdMetier", referencedColumnName="Id")
     * })
     */
    private $idmetier;

    /**
     * @var \Typecontrat
     *
     * @ORM\ManyToOne(targetEntity="Typecontrat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdTypeContrat", referencedColumnName="Id")
     * })
     */
    private $idtypecontrat;

    /**
     * @var \Annonceur
     *
     * @ORM\ManyToOne(targetEntity="Annonceur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdAnnonceur", referencedColumnName="Id")
     * })
     */
    private $idannonceur;



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
     * Set intitule
     *
     * @param string $intitule
     * @return Offre
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule
     *
     * @return string 
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set reference
     *
     * @param string $reference
     * @return Offre
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string 
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set datepublication
     *
     * @param \DateTime $datepublication
     * @return Offre
     */
    public function setDatepublication($datepublication)
    {
        $this->datepublication = $datepublication;

        return $this;
    }

    /**
     * Get datepublication
     *
     * @return \DateTime 
     */
    public function getDatepublication()
    {
        return $this->datepublication;
    }

    /**
     * Set dureediffusion
     *
     * @param integer $dureediffusion
     * @return Offre
     */
    public function setDureediffusion($dureediffusion)
    {
        $this->dureediffusion = $dureediffusion;

        return $this;
    }

    /**
     * Get dureediffusion
     *
     * @return integer 
     */
    public function getDureediffusion()
    {
        return $this->dureediffusion;
    }

    /**
     * Set datedebutcontrat
     *
     * @param \DateTime $datedebutcontrat
     * @return Offre
     */
    public function setDatedebutcontrat($datedebutcontrat)
    {
        $this->datedebutcontrat = $datedebutcontrat;

        return $this;
    }

    /**
     * Get datedebutcontrat
     *
     * @return \DateTime 
     */
    public function getDatedebutcontrat()
    {
        return $this->datedebutcontrat;
    }

    /**
     * Set nbposte
     *
     * @param integer $nbposte
     * @return Offre
     */
    public function setNbposte($nbposte)
    {
        $this->nbposte = $nbposte;

        return $this;
    }

    /**
     * Get nbposte
     *
     * @return integer 
     */
    public function getNbposte()
    {
        return $this->nbposte;
    }

    /**
     * Set localisationlattitude
     *
     * @param string $localisationlattitude
     * @return Offre
     */
    public function setLocalisationlattitude($localisationlattitude)
    {
        $this->localisationlattitude = $localisationlattitude;

        return $this;
    }

    /**
     * Get localisationlattitude
     *
     * @return string 
     */
    public function getLocalisationlattitude()
    {
        return $this->localisationlattitude;
    }

    /**
     * Set localisationlongitude
     *
     * @param string $localisationlongitude
     * @return Offre
     */
    public function setLocalisationlongitude($localisationlongitude)
    {
        $this->localisationlongitude = $localisationlongitude;

        return $this;
    }

    /**
     * Get localisationlongitude
     *
     * @return string 
     */
    public function getLocalisationlongitude()
    {
        return $this->localisationlongitude;
    }

    /**
     * Set descriptionposte
     *
     * @param string $descriptionposte
     * @return Offre
     */
    public function setDescriptionposte($descriptionposte)
    {
        $this->descriptionposte = $descriptionposte;

        return $this;
    }

    /**
     * Get descriptionposte
     *
     * @return string 
     */
    public function getDescriptionposte()
    {
        return $this->descriptionposte;
    }

    /**
     * Set descriptionprofil
     *
     * @param string $descriptionprofil
     * @return Offre
     */
    public function setDescriptionprofil($descriptionprofil)
    {
        $this->descriptionprofil = $descriptionprofil;

        return $this;
    }

    /**
     * Get descriptionprofil
     *
     * @return string 
     */
    public function getDescriptionprofil()
    {
        return $this->descriptionprofil;
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return Offre
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string 
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Offre
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set iddomaine
     *
     * @param \MC\MegaCastingBundle\Entity\Domaine $iddomaine
     * @return Offre
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
     * Set idmetier
     *
     * @param \MC\MegaCastingBundle\Entity\Metier $idmetier
     * @return Offre
     */
    public function setIdmetier(\MC\MegaCastingBundle\Entity\Metier $idmetier = null)
    {
        $this->idmetier = $idmetier;

        return $this;
    }

    /**
     * Get idmetier
     *
     * @return \MC\MegaCastingBundle\Entity\Metier 
     */
    public function getIdmetier()
    {
        return $this->idmetier;
    }

    /**
     * Set idtypecontrat
     *
     * @param \MC\MegaCastingBundle\Entity\Typecontrat $idtypecontrat
     * @return Offre
     */
    public function setIdtypecontrat(\MC\MegaCastingBundle\Entity\Typecontrat $idtypecontrat = null)
    {
        $this->idtypecontrat = $idtypecontrat;

        return $this;
    }

    /**
     * Get idtypecontrat
     *
     * @return \MC\MegaCastingBundle\Entity\Typecontrat 
     */
    public function getIdtypecontrat()
    {
        return $this->idtypecontrat;
    }

    /**
     * Set idannonceur
     *
     * @param \MC\MegaCastingBundle\Entity\Annonceur $idannonceur
     * @return Offre
     */
    public function setIdannonceur(\MC\MegaCastingBundle\Entity\Annonceur $idannonceur = null)
    {
        $this->idannonceur = $idannonceur;

        return $this;
    }

    /**
     * Get idannonceur
     *
     * @return \MC\MegaCastingBundle\Entity\Annonceur 
     */
    public function getIdannonceur()
    {
        return $this->idannonceur;
    }
}
