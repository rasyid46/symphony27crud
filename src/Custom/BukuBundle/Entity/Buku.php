<?php

namespace Custom\BukuBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Buku
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Custom\BukuBundle\Entity\BukuRepository")
 */
class Buku
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="author", type="string", length=200)
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="language", type="string", length=100)
     */
    private $language;

    /**
     * @var string
     *
     * @ORM\Column(name="publisher", type="string", length=100)
     */
    private $publisher;

    /**
     * @var string
     *
     * @ORM\Column(name="summary", type="text")
     */
    private $summary;


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
     * @return Buku
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
     * Set author
     *
     * @param string $author
     * @return Buku
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set language
     *
     * @param string $language
     * @return Buku
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set publisher
     *
     * @param string $publisher
     * @return Buku
     */
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * Get publisher
     *
     * @return string 
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * Set summary
     *
     * @param string $summary
     * @return Buku
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string 
     */
    public function getSummary()
    {
        return $this->summary;
    }
}
