<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Voiture
 *
 * @ORM\Table(name="voiture")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\VoitureRepository")
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
     * @ORM\Column(name="matricule", type="string", length=15, unique=true)
     */
    private $matricule;

    /**
     * @var string
     *
     * @ORM\Column(name="couleur", type="string", length=20)
     */
    private $couleur;

    /**
     * @var string
     *
     * @ORM\Column(name="diesel", type="string", length=10)
     */
    private $diesel;

    /**
     * @var int
     *
     * @ORM\Column(name="nbChevaux", type="integer")
     */
    private $nbChevaux;

    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer")
     */
    private $prix;

    /**
     * @var string
     * 
     * @Assert\NotBlank(groups={"new"})
     * @Assert\File(mimeTypes={"image/png" , "image/jpg" , "image/jpeg" })
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=20)
     */
    private $libelle;


    /**
     * 
     *
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\Agent", cascade={"persist"})
     */
    private $agent;

    /**
     * 
     *
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\Agence", cascade={"persist"})
     */
    private $agence;

  


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
     * Set matricule
     *
     * @param string $matricule
     *
     * @return Voiture
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;

        return $this;
    }

    /**
     * Get matricule
     *
     * @return string
     */
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * Set couleur
     *
     * @param string $couleur
     *
     * @return Voiture
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Set diesel
     *
     * @param string $diesel
     *
     * @return Voiture
     */
    public function setDiesel($diesel)
    {
        $this->diesel = $diesel;

        return $this;
    }

    /**
     * Get diesel
     *
     * @return string
     */
    public function getDiesel()
    {
        return $this->diesel;
    }

    /**
     * Set nbChevaux
     *
     * @param integer $nbChevaux
     *
     * @return Voiture
     */
    public function setNbChevaux($nbChevaux)
    {
        $this->nbChevaux = $nbChevaux;

        return $this;
    }

    /**
     * Get nbChevaux
     *
     * @return int
     */
    public function getNbChevaux()
    {
        return $this->nbChevaux;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     *
     * @return Voiture
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Voiture
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Voiture
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
     * Set agent
     *
     * @param \AdminBundle\Entity\Agent $agent
     *
     * @return Voiture
     */
    public function setAgent(\AdminBundle\Entity\Agent $agent = null)
    {
        $this->agent = $agent;

        return $this;
    }

    /**
     * Get agent
     *
     * @return \AdminBundle\Entity\Agent
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * Set agence
     *
     * @param \AdminBundle\Entity\Agence $agence
     *
     * @return Voiture
     */
    public function setAgence(\AdminBundle\Entity\Agence $agence = null)
    {
        $this->agence = $agence;

        return $this;
    }

    /**
     * Get agence
     *
     * @return \AdminBundle\Entity\Agence
     */
    public function getAgence()
    {
        return $this->agence;
    }

    /**
     * Set reservation
     *
     * @param \AdminBundle\Entity\reservation $reservation
     *
     * @return Voiture
     */
    public function setReservation(\AdminBundle\Entity\reservation $reservation = null)
    {
        $this->reservation = $reservation;

        return $this;
    }

    /**
     * Get reservation
     *
     * @return \AdminBundle\Entity\reservation
     */
    public function getReservation()
    {
        return $this->reservation;
    }
}
