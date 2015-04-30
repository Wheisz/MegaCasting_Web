<?php

namespace MC\MegaCastingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\RoleInterface;

/**
 * Role
 *
 * @ORM\Table(name="Role")
 * @ORM\Entity
 */
class Role implements RoleInterface, \Serializable
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
     * @ORM\Column(name="Name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Role", type="string", length=255, nullable=false)
     */
    private $role;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Utilisateur", inversedBy="roles")
     * @ORM\JoinTable(name="role_utilisateur",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Role_id", referencedColumnName="Id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Utilisateur_id", referencedColumnName="Id")
     *   }
     * )
     */
    private $utilisateur;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->utilisateur = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Role
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return Role
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * @see RoleInterface
     * 
     * @return Role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Add utilisateur
     *
     * @param \MC\MegaCastingBundle\Entity\Utilisateur $utilisateur
     * @return Role
     */
    public function addUtilisateur(\MC\MegaCastingBundle\Entity\Utilisateur $utilisateur)
    {
        $this->utilisateur[] = $utilisateur;

        return $this;
    }

    /**
     * Remove utilisateur
     *
     * @param \MC\MegaCastingBundle\Entity\Utilisateur $utilisateur
     */
    public function removeUtilisateur(\MC\MegaCastingBundle\Entity\Utilisateur $utilisateur)
    {
        $this->utilisateur->removeElement($utilisateur);
    }

    /**
     * Get utilisateur
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUtilisateur()
    {
        return $this->utilisateur;
    }
    
    public function __toString()
    {
        return $this->getName();
    }
    
    /**
     * Serializes the content of the current User object
     * @return string
     */
    public function serialize()
    {
        return \json_encode(
                array($this->role, $this->id));
    }

    /**
     * Unserializes the given string in the current User object
     * @param serialized
     */
    public function unserialize($serialized)
    {
        list($this->role, $this->id) = \json_decode(
                $serialized);
    }
}
