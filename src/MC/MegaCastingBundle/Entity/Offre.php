<?php

namespace MC\MegaCastingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;


/**
 * Offre
 *
 * @ORM\Table(name="Offre", uniqueConstraints={@ORM\UniqueConstraint(name="UK_Offre", columns={"Reference"})}, indexes={@ORM\Index(name="IFK_Offre_Domaine", columns={"Domaine_id"}), @ORM\Index(name="IFK_Offre_Metier", columns={"Metier_id"}), @ORM\Index(name="IFK_Offre_TypeContrat", columns={"TypeContrat_id"}), @ORM\Index(name="IFK_Offre_Annonceur", columns={"Annonceur_id"})})
 * @ORM\Entity
 * @ExclusionPolicy("all")
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
     * @Assert\NotBlank(message="L'intitulé doit être renseigné")
     * @expose
     */
    private $intitule;

    /**
     * @var string
     *
     * @ORM\Column(name="Reference", type="string", length=100, nullable=false)
     * 
     * @Assert\NotBlank(message="La référence de la diffusion doit être renseignée")
     * @expose
     */
    private $reference;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="DatePublication", type="datetime", nullable=true)
     * @expose
     */
    private $datepublication;

    /**
     * @var integer
     *
     * @ORM\Column(name="DureeDiffusion", type="integer", nullable=false)
     * @Assert\NotBlank(message="La durée de la diffusion doit être renseignée")
     * @expose
     */
    private $dureediffusion;

    /**
     * @var \Date
     *
     * @ORM\Column(name="DateDebutContrat", type="date", nullable=false)
     * @Assert\NotBlank(message="La date du début du contrat doit être renseignée")
     * @expose
     */
    private $datedebutcontrat;

    /**
     * @var integer
     *
     * @ORM\Column(name="NbPoste", type="integer", nullable=false)
     * @Assert\NotBlank(message="Le nombre de postes doit être renseigné")
     * @expose
     */
    private $nbposte;

    /**
     * @var string
     *
     * @ORM\Column(name="LocalisationLattitude", type="string", length=50, nullable=false)
     * @Assert\NotBlank(message="La lattitude doit être renseignée")
     * @Assert\Regex(
     *      pattern="/^[0-9]{2}° [0-9]{2}' [N-S-E-O]{1}$/",
     *      message="Veuillez respecter le schéma suivant : 10° 10' S",
     * )
     * @expose
     */
    private $localisationlattitude;

    /**
     * @var string
     *
     * @ORM\Column(name="LocalisationLongitude", type="string", length=50, nullable=false)
     * @Assert\NotBlank(message="La longitude doit être renseignée")
     * @Assert\Regex(
     *      pattern="/^[0-9]{2}° [0-9]{2}' [N-S-E-O]{1}$/",
     *      message="Veuillez respecter le schéma suivant : 10° 10' S",
     * )
     * @expose
     */
    private $localisationlongitude;

    /**
     * @var string
     *
     * @ORM\Column(name="DescriptionPoste", type="text", length=16, nullable=false)
     * @Assert\NotBlank(message="La description du poste doit être renseignée")
     * @expose
     */
    private $descriptionposte;

    /**
     * @var string
     *
     * @ORM\Column(name="DescriptionProfil", type="text", length=16, nullable=false)
     * @Assert\NotBlank(message="La description du profil doit être renseignée")
     * @expose
     */
    private $descriptionprofil;

    /**
     * @var string
     *
     * @ORM\Column(name="Telephone", type="string", length=50, nullable=false)
     * @Assert\NotBlank(message="Le téléphone doit être renseigné")
     * 
     * @Assert\Regex(
     *      pattern="/^0[1-68]([.-]?[0-9]{2}){4}$/",
     *      message="{{ value }} n'est pas un numéro de téléphone valide",
     * )
     * @expose
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=50, nullable=false)
     * @Assert\NotBlank(message="L'e-mail doit être renseigné")
     * @Assert\Email(
     *     message = "'{{ value }}' n'est pas un email valide.",
     *     checkMX = true
     * )
     * @expose
     */
    private $email;

    /**
     * @var boolean
     *
     * @ORM\Column(name="EstValide", type="boolean", nullable=false)
     * @expose
     */
    private $estvalide = 'false';

    /**
     * @var \Domaine
     *
     * @ORM\ManyToOne(targetEntity="Domaine")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Domaine_id", referencedColumnName="Id")
     * })
     * 
     * @Assert\NotBlank(message="Un domaine doit être renseigné")
     * @expose
     */
    private $domaine;

    /**
     * @var \Metier
     *
     * @ORM\ManyToOne(targetEntity="Metier")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Metier_id", referencedColumnName="Id")
     * })
     * 
     * @Assert\NotBlank(message="Un métier doit être renseigné")
     * @expose
     */
    private $metier;

    /**
     * @var \Typecontrat
     *
     * @ORM\ManyToOne(targetEntity="Typecontrat")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Typecontrat_id", referencedColumnName="Id")
     * })
     * 
     * @Assert\NotBlank(message="Un type de contrat doit être renseigné")
     * @expose
     */
    private $typecontrat;

    /**
     * @var \Annonceur
     *
     * @ORM\ManyToOne(targetEntity="Annonceur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Annonceur_id", referencedColumnName="Id")
     * })
     * @expose
     */
    private $annonceur;



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
     * Set estvalide
     *
     * @param boolean $estvalide
     * @return Offre
     */
    public function setEstvalide($estvalide)
    {
        $this->estvalide = $estvalide;

        return $this;
    }

    /**
     * Get estvalide
     *
     * @return boolean 
     */
    public function getEstvalide()
    {
        return $this->estvalide;
    }

    /**
     * Set domaine
     *
     * @param \MC\MegaCastingBundle\Entity\Domaine $domaine
     * @return Offre
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
     * Set metier
     *
     * @param \MC\MegaCastingBundle\Entity\Metier $metier
     * @return Offre
     */
    public function setMetier(\MC\MegaCastingBundle\Entity\Metier $metier = null)
    {
        $this->metier = $metier;

        return $this;
    }

    /**
     * Get metier
     *
     * @return \MC\MegaCastingBundle\Entity\Metier 
     */
    public function getMetier()
    {
        return $this->metier;
    }

    /**
     * Set typecontrat
     *
     * @param \MC\MegaCastingBundle\Entity\Typecontrat $typecontrat
     * @return Offre
     */
    public function setTypecontrat(\MC\MegaCastingBundle\Entity\Typecontrat $typecontrat = null)
    {
        $this->typecontrat = $typecontrat;

        return $this;
    }

    /**
     * Get typecontrat
     *
     * @return \MC\MegaCastingBundle\Entity\Typecontrat 
     */
    public function getTypecontrat()
    {
        return $this->typecontrat;
    }

    /**
     * Set annonceur
     *
     * @param \MC\MegaCastingBundle\Entity\Annonceur $annonceur
     * @return Offre
     */
    public function setAnnonceur(\MC\MegaCastingBundle\Entity\Annonceur $annonceur = null)
    {
        $this->annonceur = $annonceur;

        return $this;
    }

    /**
     * Get annonceur
     *
     * @return \MC\MegaCastingBundle\Entity\Annonceur 
     */
    public function getAnnonceur()
    {
        return $this->annonceur;
    }
}
