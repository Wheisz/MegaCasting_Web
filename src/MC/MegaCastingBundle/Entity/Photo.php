<?php

namespace MC\MegaCastingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Photo
 *
 * @ORM\Table(name="Photo", indexes={@ORM\Index(name="IFK_Photo_Artiste", columns={"IdArtiste"})})
 * @ORM\Entity
 */
class Photo
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
     * @ORM\Column(name="Libelle", type="string", length=255, nullable=false)
     */
    private $libelle;

    /**
     * @var integer
     *
     * @ORM\Column(name="IsProfile", type="integer", nullable=true)
     */
    private $isprofile;

    /**
     * @var \Artiste
     *
     * @ORM\ManyToOne(targetEntity="Artiste", inversedBy="photos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IdArtiste", referencedColumnName="Id")
     * })
     */
    private $idartiste;



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
     * @return Photo
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
     * Set isprofile
     *
     * @param integer $isprofile
     * @return Photo
     */
    public function setIsprofile($isprofile)
    {
        $this->isprofile = $isprofile;

        return $this;
    }

    /**
     * Get isprofile
     *
     * @return integer 
     */
    public function getIsprofile()
    {
        return $this->isprofile;
    }

    /**
     * Set idartiste
     *
     * @param \MC\MegaCastingBundle\Entity\Artiste $idartiste
     * @return Photo
     */
    public function setIdartiste(\MC\MegaCastingBundle\Entity\Artiste $idartiste = null)
    {
        $this->idartiste = $idartiste;

        return $this;
    }

    /**
     * Get idartiste
     *
     * @return \MC\MegaCastingBundle\Entity\Artiste 
     */
    public function getIdartiste()
    {
        return $this->idartiste;
    }
}
