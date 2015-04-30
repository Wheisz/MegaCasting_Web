<?php

namespace MC\MegaCastingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Photo
 *
 * @ORM\Table(name="Photo", indexes={@ORM\Index(name="IFK_Photo_Artiste", columns={"Artiste_id"})})
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
     * @ORM\Column(name="Url", type="string", length=255, nullable=false)
     */
    private $url;

    /**
     * @var integer
     *
     * @ORM\Column(name="IsProfile", type="integer", nullable=true)
     */
    private $isprofile;

    /**
     * @var string
     *
     * @ORM\Column(name="Alt", type="string", length=255, nullable=true)
     */
    private $alt;

    /**
     * @var \Artiste
     *
     * @ORM\ManyToOne(targetEntity="Artiste", inversedBy="photos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Artiste_id", referencedColumnName="Id")
     * })
     */
    private $artiste;



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
     * Set url
     *
     * @param string $url
     * @return Photo
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
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
     * Set alt
     *
     * @param string $alt
     * @return Photo
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string 
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set artiste
     *
     * @param \MC\MegaCastingBundle\Entity\Artiste $artiste
     * @return Photo
     */
    public function setArtiste(\MC\MegaCastingBundle\Entity\Artiste $artiste = null)
    {
        $this->artiste = $artiste;

        return $this;
    }

    /**
     * Get artiste
     *
     * @return \MC\MegaCastingBundle\Entity\Artiste 
     */
    public function getArtiste()
    {
        return $this->artiste;
    }
    
    
    private $file;
  
    public function getFile()
    {
        return $this->file;
    }

    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }
    
    public function upload()
    {
        // Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
        if (null === $this->file) {
          return;
        }

        // On récupère le nom original du fichier de l'internaute
        $name = $this->file->getClientOriginalName();

        // On déplace le fichier envoyé dans le répertoire de notre choix
        $this->file->move($this->getUploadRootDir(), $name);

        // On sauvegarde le nom de fichier dans notre attribut $url
        $this->url = $name;

        // On crée également le futur attribut alt de notre balise <img>
        $this->alt = $name;
    }

    public function getUploadDir()
    {
        // On retourne le chemin relatif vers l'image pour un navigateur (relatif au répertoire /web donc)
        return 'bundles/mcmegacasting/img/artiste/' . $this->artiste->getUtilisateur()->getUsername() . '/';
    }

    protected function getUploadRootDir()
    {
        // On retourne le chemin relatif vers l'image pour notre code PHP
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }
}
