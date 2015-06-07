<?php

namespace MC\MegaCastingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * Adresse
 *
 * @ORM\Table(name="Adresse", uniqueConstraints={@ORM\UniqueConstraint(name="UK_Adresse", columns={"Numero", "Rue", "CodePostal", "Ville"})})
 * @ORM\Entity
 * @ExclusionPolicy("all")
 */
class Adresse
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
     * @ORM\Column(name="Numero", type="integer", nullable=true)
     * 
     * @Assert\Regex(
     *      pattern="/^[0-9]*$/",
     *      message="Mauvais format pour un numéro",
     * )
     * @expose
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="Rue", type="string", length=250, nullable=true)
     * 
     * @Assert\Regex(
     *      pattern="/^[a-zA-Z-éèëäâàüûïîöô ]*$/",
     *      message="Mauvais format pour une rue",
     * )
     * @expose
     */
    private $rue;

    /**
     * @var string
     *
     * @ORM\Column(name="CodePostal", type="string", length=5, nullable=true)
     * 
     * @Assert\Regex(
     *      pattern="/^[0-9]{5}$/",
     *      message="Mauvais format pour un code postal",
     * )
     */
    private $codepostal;

    /**
     * @var string
     *
     * @ORM\Column(name="Ville", type="string", length=100, nullable=true)
     * 
     * @Assert\Regex(
     *      pattern="/^[a-zA-Z-éèëäâàüûïîöô ]*$/",
     *      message="Mauvais format pour une ville",
     * )
     * @expose
     */
    private $ville;

    /**
     * 
     * @ORM\OneToOne(
     *      targetEntity="Societe",
     *      mappedBy="adresse"
     * )
     */
    private $societe;

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
     * Set numero
     *
     * @param integer $numero
     * @return Adresse
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return integer 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set rue
     *
     * @param string $rue
     * @return Adresse
     */
    public function setRue($rue)
    {
        $this->rue = $rue;

        return $this;
    }

    /**
     * Get rue
     *
     * @return string 
     */
    public function getRue()
    {
        return $this->rue;
    }

    /**
     * Set codepostal
     *
     * @param string $codepostal
     * @return Adresse
     */
    public function setCodepostal($codepostal)
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    /**
     * Get codepostal
     *
     * @return string 
     */
    public function getCodepostal()
    {
        return $this->codepostal;
    }

    /**
     * Set ville
     *
     * @param string $ville
     * @return Adresse
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string 
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set societe
     *
     * @param \MC\MegaCastingBundle\Entity\Societe $societe
     * @return Adresse
     */
    public function setSociete(\MC\MegaCastingBundle\Entity\Societe $societe = null)
    {
        $this->societe = $societe;

        return $this;
    }

    /**
     * Get societe
     *
     * @return \MC\MegaCastingBundle\Entity\Societe 
     */
    public function getSociete()
    {
        return $this->societe;
    }
}
