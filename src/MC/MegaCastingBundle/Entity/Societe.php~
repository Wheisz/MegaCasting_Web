<?php

namespace MC\MegaCastingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Societe
 *
 * @ORM\Table(name="Societe", uniqueConstraints={@ORM\UniqueConstraint(name="UK_Societe", columns={"RaisonSociale"})}, indexes={@ORM\Index(name="IFK_Societe_Adresse", columns={"IdAdresse"})})
 * @ORM\Entity
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
     * @ORM\Column(name="NumeroSiret", type="bigint", nullable=false)
     */
    private $numerosiret;

    /**
     * @var string
     *
     * @ORM\Column(name="RaisonSociale", type="string", length=100, nullable=false)
     */
    private $raisonsociale;

    /**
     * @var string
     *
     * @ORM\Column(name="Email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="Telephone", type="string", length=50, nullable=false)
     */
    private $telephone;

    /**
     * @var \Adresse
     *
     * @ORM\ManyToOne(targetEntity="Adresse")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdAdresse", referencedColumnName="Id")
     * })
     */
    private $idadresse;



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
     * Set idadresse
     *
     * @param \MC\MegaCastingBundle\Entity\Adresse $idadresse
     * @return Societe
     */
    public function setIdadresse(\MC\MegaCastingBundle\Entity\Adresse $idadresse = null)
    {
        $this->idadresse = $idadresse;

        return $this;
    }

    /**
     * Get idadresse
     *
     * @return \MC\MegaCastingBundle\Entity\Adresse 
     */
    public function getIdadresse()
    {
        return $this->idadresse;
    }
}
