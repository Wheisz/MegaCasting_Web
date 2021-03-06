<?php

namespace MC\MegaCastingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * Societe
 *
 * @ORM\Table(name="Societe", uniqueConstraints={@ORM\UniqueConstraint(name="UK_Societe", columns={"RaisonSociale"})}, indexes={@ORM\Index(name="IFK_Societe_Adresse", columns={"Adresse_id"})})
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"annonceur" = "MC\MegaCastingBundle\Entity\Annonceur", "diffuseur" = "MC\MegaCastingBundle\Entity\Diffuseur"})
 * @ExclusionPolicy("all")
 */
class Societe
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
     * @var integer
     *
     * @ORM\Column(name="NumeroSiret", type="bigint", nullable=true)
     * 
     * @Assert\Regex(
     *      pattern="/^[0-9]{14}$/",
     *      message="{{ value }} n'est pas un numéro de SIRET valide",
     * )
     * @expose
     */
    private $numerosiret;

    /**
     * @var string
     *
     * @ORM\Column(name="RaisonSociale", type="string", length=100, nullable=true)
     * @expose
     */
    private $raisonsociale;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=50, nullable=true)
     * @expose
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="Telephone", type="string", length=50, nullable=true)
     * 
     * @Assert\Regex(
     *      pattern="/^0[1-68]([.-]?[0-9]{2}){4}$/",
     *      message="{{ value }} n'est pas un numéro de téléphone valide",
     * )
     * @expose
     */
    private $telephone;

    /**
     * @var \Adresse
     *
     * @ORM\OneToOne(targetEntity="Adresse", inversedBy="societe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Adresse_id", referencedColumnName="Id")
     * })
     * @expose
     */
    private $adresse;


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
     * Set numerosiret
     *
     * @param integer $numerosiret
     * @return Societe
     */
    public function setNumerosiret($numerosiret)
    {
        $this->numerosiret = $numerosiret;

        return $this;
    }

    /**
     * Get numerosiret
     *
     * @return integer 
     */
    public function getNumerosiret()
    {
        return $this->numerosiret;
    }

    /**
     * Set raisonsociale
     *
     * @param string $raisonsociale
     * @return Societe
     */
    public function setRaisonsociale($raisonsociale)
    {
        $this->raisonsociale = $raisonsociale;

        return $this;
    }

    /**
     * Get raisonsociale
     *
     * @return string 
     */
    public function getRaisonsociale()
    {
        return $this->raisonsociale;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Societe
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
     * Set telephone
     *
     * @param string $telephone
     * @return Societe
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
     * Set adresse
     *
     * @param \MC\MegaCastingBundle\Entity\Adresse $adresse
     * @return Societe
     */
    public function setAdresse(\MC\MegaCastingBundle\Entity\Adresse $adresse = null)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return \MC\MegaCastingBundle\Entity\Adresse 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }
}
