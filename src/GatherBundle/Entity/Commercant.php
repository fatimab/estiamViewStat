<?php

namespace GatherBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commercant
 *
 * @ORM\Table(name="commercant")
 * @ORM\Entity(repositoryClass="GatherBundle\Repository\CommercantRepository")
 */
class Commercant
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=255)
     */
    private $numero;

    /**
     * @var integer
     *
     * @ORM\Column(name="revenus", type="integer", length=255)
     */
    private $revenus;

    /**
     * @var string
     *
     * @ORM\Column(name="marche", type="string", length=255)
     */
    private $marche;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Commercant
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Commercant
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Commercant
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set numero
     *
     * @param string $numero
     *
     * @return Commercant
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get numero
     *
     * @return string
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set revenus
     *
     * @param integer $revenus
     *
     * @return Commercant
     */
    public function setRevenus($revenus)
    {
        $this->revenus = $revenus;

        return $this;
    }

    /**
     * Get revenus
     *
     * @return integer
     */
    public function getRevenus()
    {
        return $this->revenus;
    }

    /**
     * Set marche
     *
     * @param string $marche
     *
     * @return Commercant
     */
    public function setMarche($marche)
    {
        $this->marche = $marche;

        return $this;
    }

    /**
     * Get marche
     *
     * @return string
     */
    public function getMarche()
    {
        return $this->marche;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Commercant
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}

