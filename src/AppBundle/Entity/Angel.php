<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * @ORM\Entity(repositoryClass="AngelRepository")
 * @ORM\Table(name="angel")
 */
class Angel{

	/**
	 * @ORM\Column(type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\Column(type="string")
	 */
	protected $name;

	/**
     * @OneToMany(targetEntity="Quote", mappedBy="angel")
     */
	private $quotes;

    public function __construct(){
        $this->quotes = new ArrayCollection();
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
     * @return Angel
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
     * Add quotes
     *
     * @param \AppBundle\Entity\Quote $quotes
     * @return Angel
     */
    public function addQuote(\AppBundle\Entity\Quote $quotes)
    {
        $this->quotes[] = $quotes;

        return $this;
    }

    /**
     * Remove quotes
     *
     * @param \AppBundle\Entity\Quote $quotes
     */
    public function removeQuote(\AppBundle\Entity\Quote $quotes)
    {
        $this->quotes->removeElement($quotes);
    }

    /**
     * Get quotes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getQuotes()
    {
        return $this->quotes;
    }
}
