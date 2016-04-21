<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * @ORM\Entity(repositoryClass="QuoteRepository")
 * @ORM\Table(name="quote")
 * @ORM\HasLifecycleCallbacks()
 */
class Quote{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $text;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;

    /**
     * @ManyToOne(targetEntity="Angel", inversedBy="quotes")
     * @JoinColumn(name="angel_id", referencedColumnName="id")
     */
    private $angel;

    /**
     * @ORM\PrePersist() 
     */
    public function PrePersist()
    {
        if($this->getCreatedAt()== null){
            $this->setCreatedAt(new \DateTime('now'));
        }
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
     * Set text
     *
     * @param string $text
     * @return Quote
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Quote
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set angel
     *
     * @param \AppBundle\Entity\Angel $angel
     * @return Quote
     */
    public function setAngel(\AppBundle\Entity\Angel $angel = null)
    {
        $this->angel = $angel;

        return $this;
    }

    /**
     * Get angel
     *
     * @return \AppBundle\Entity\Angel 
     */
    public function getAngel()
    {
        return $this->angel;
    }
}
