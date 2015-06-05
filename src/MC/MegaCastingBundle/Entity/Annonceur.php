<?php

namespace MC\MegaCastingBundle\Entity;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

use Doctrine\ORM\Mapping as ORM;

/**
 * Annonceur
 *
 * @ORM\Table(name="Annonceur", indexes={@ORM\Index(name="IFK_Annonceur_Utilisateur", columns={"Utilisateur_id"})})
 * @ORM\Entity
 * @ExclusionPolicy("all")
 */
class Annonceur extends Societe
{
    /**
     * @var \Societe
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Societe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Id", referencedColumnName="Id")
     * })
     */
    private $id;

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
     * Set id
     *
     * @param \MC\MegaCastingBundle\Entity\Societe $id
     * @return Annonceur
     */
    public function setId(\MC\MegaCastingBundle\Entity\Societe $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return \MC\MegaCastingBundle\Entity\Societe 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set utilisateur
     *
     * @param \MC\MegaCastingBundle\Entity\Utilisateur $utilisateur
     * @return Annonceur
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
}
