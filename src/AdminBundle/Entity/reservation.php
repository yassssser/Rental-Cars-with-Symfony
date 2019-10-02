<?php

namespace AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="AdminBundle\Repository\reservationRepository")
 */
class reservation
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_deb", type="datetime")
     */
    private $dateDeb;

    /**
     * @var int
     *
     * @ORM\Column(name="nbJours", type="integer")
     */
    private $nbJours;

    /**
     * 
     *
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\Client", cascade={"persist"})
     */
    private $client;

    /**
     * 
     *
     * @ORM\ManyToOne(targetEntity="AdminBundle\Entity\Voiture", cascade={"persist"})
     */
    private $voiture;

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
     * Set dateDeb
     *
     * @param \DateTime $dateDeb
     *
     * @return reservation
     */
    public function setDateDeb($dateDeb)
    {
        $this->dateDeb = $dateDeb;

        return $this;
    }

    /**
     * Get dateDeb
     *
     * @return \DateTime
     */
    public function getDateDeb()
    {
        return $this->dateDeb;
    }

    /**
     * Set nbJours
     *
     * @param integer $nbJours
     *
     * @return reservation
     */
    public function setNbJours($nbJours)
    {
        $this->nbJours = $nbJours;

        return $this;
    }

    /**
     * Get nbJours
     *
     * @return int
     */
    public function getNbJours()
    {
        return $this->nbJours;
    }

    /**
     * Set client
     *
     * @param \AdminBundle\Entity\Client $client
     *
     * @return reservation
     */
    public function setClient(\AdminBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \AdminBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set voiture
     *
     * @param \AdminBundle\Entity\Voiture $voiture
     *
     * @return reservation
     */
    public function setVoiture(\AdminBundle\Entity\Voiture $voiture = null)
    {
        $this->voiture = $voiture;

        return $this;
    }

    /**
     * Get voiture
     *
     * @return \AdminBundle\Entity\Voiture
     */
    public function getVoiture()
    {
        return $this->voiture;
    }
}