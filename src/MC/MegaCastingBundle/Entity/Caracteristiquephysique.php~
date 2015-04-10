<?php

namespace MC\MegaCastingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Caracteristiquephysique
 *
 * @ORM\Table(name="CaracteristiquePhysique")
 * @ORM\Entity
 */
class Caracteristiquephysique
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
     * @ORM\Column(name="Taille", type="integer", nullable=true)
     */
    private $taille;

    /**
     * @var integer
     *
     * @ORM\Column(name="Poids", type="integer", nullable=true)
     */
    private $poids;

    /**
     * @var string
     *
     * @ORM\Column(name="CouleurYeux", type="string", length=50, nullable=true)
     */
    private $couleuryeux;

    /**
     * @var string
     *
     * @ORM\Column(name="CouleurCheveux", type="string", length=50, nullable=true)
     */
    private $couleurcheveux;



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
     * Set taille
     *
     * @param integer $taille
     * @return Caracteristiquephysique
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * Get taille
     *
     * @return integer 
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * Set poids
     *
     * @param integer $poids
     * @return Caracteristiquephysique
     */
    public function setPoids($poids)
    {
        $this->poids = $poids;

        return $this;
    }

    /**
     * Get poids
     *
     * @return integer 
     */
    public function getPoids()
    {
        return $this->poids;
    }

    /**
     * Set couleuryeux
     *
     * @param string $couleuryeux
     * @return Caracteristiquephysique
     */
    public function setCouleuryeux($couleuryeux)
    {
        $this->couleuryeux = $couleuryeux;

        return $this;
    }

    /**
     * Get couleuryeux
     *
     * @return string 
     */
    public function getCouleuryeux()
    {
        return $this->couleuryeux;
    }

    /**
     * Set couleurcheveux
     *
     * @param string $couleurcheveux
     * @return Caracteristiquephysique
     */
    public function setCouleurcheveux($couleurcheveux)
    {
        $this->couleurcheveux = $couleurcheveux;

        return $this;
    }

    /**
     * Get couleurcheveux
     *
     * @return string 
     */
    public function getCouleurcheveux()
    {
        return $this->couleurcheveux;
    }
}
