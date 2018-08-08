<?php

namespace Myapp\ParcBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Voiture
 *
 * @ORM\Table(name="voiture")
 * @ORM\Entity(repositoryClass="Myapp\ParcBundle\Repository\VoitureRepository")
 */
class Voiture
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="serie", type="string", length=255)
     */
    private $serie;
     /**
     * @var string
     *
     * @ORM\Column( type="string", length=255,nullable=true)
     */
    
    public $nomImage;
     /**
     * @Assert\File(maxSize="500k")
     */
    public $file;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="marque", type="string", length=255)
     */
    private $marque;

       /**
   * @ORM\ManyToOne(targetEntity="Modele")
   * @ORM\JoinColumn(name="id_modele", referencedColumnName="id")}
    */
   private $modele;
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set serie
     *
     * @param string $serie
     *
     * @return Voiture
     */
    public function setSerie($serie)
    {
        $this->serie = $serie;

        return $this;
    }
    
    public function getWebPath()
    {
        return null===$this->nomImage ? null :$this->getUploadDir.'/'.$this->nomImage;
    }
    
     protected function getUploadRootDir()
    {
       
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    } 
        protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'images';
    }
    public function uploadProfilePicture(){
        
     $this->file->move($this->getUploadRootDir(),$this->file->getClientOriginalName());
     $this->nomImage=$this->file->getClientOriginalName();
     $this->file=null;
    }
    /**
    
     * Set nomImage
     *
     * @param string $nomImage
     * 
     * @return Categorie
     */
    
    
    public function setNomImage($nomImage) {
        $this->nomImage==$nomImage;
        return $this;
        
    }
    
        /**
     * Get nomImage
     *
     * @return string
     */
    public function getNomImage()
    {
        return $this->nomImage;
    }
    
    
    /**
     * Get serie
     *
     * @return string
     */
    public function getSerie()
    {
        return $this->serie;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Voiture
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set marque
     *
     * @param string $marque
     *
     * @return Voiture
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return string
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set modele
     *
     * @param \Myapp\ParcBundle\Entity\Modele $modele
     *
     * @return Voiture
     */
    public function setModele(\Myapp\ParcBundle\Entity\Modele $modele = null)
    {
        $this->modele = $modele;

        return $this;
    }

    /**
     * Get modele
     *
     * @return \Myapp\ParcBundle\Entity\Modele
     */
    public function getModele()
    {
        return $this->modele;
    }
  
}
