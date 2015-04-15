<?php

namespace MC\MegaCastingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Annonceur
 *
 * @ORM\Table(name="Annonceur", indexes={@ORM\Index(name="IFK_Annonceur_Utilisateur", columns={"IdUtilisateur"})})
 * @ORM\Entity
 */
class Annonceur
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
     *   @ORM\JoinColumn(name="IdUtilisateur", referencedColumnName="id")
     * })
     */
    private $idutilisateur;



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
     * Set idutilisateur
     *
     * @param \MC\MegaCastingBundle\Entity\Utilisateur $idutilisateur
     * @return Annonceur
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
}
