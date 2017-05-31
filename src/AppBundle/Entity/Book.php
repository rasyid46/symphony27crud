<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// src/AppBundle/Entity/Book.php

namespace AppBundle\Entity;

use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="book")
 * @UniqueEntity("name")
 */
class Book {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $no;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $language;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $publisher;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $summary;

    /**
     * @ORM\Column(type="string")
     *
     * * @Assert\NotBlank(message="Please, upload the product brochure as a PDF file.")
     * @Assert\File(mimeTypes={ "application/pdf" })
     */
    private $brochure;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set no
     *
     * @param string $no
     * @return Book
     */
    public function setNo($no) {
        $this->no = $no;

        return $this;
    }

    /**
     * Get no
     *
     * @return string 
     */
    public function getNo() {
        return $this->no;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Book
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set author
     *
     * @param string $author
     * @return Book
     */
    public function setAuthor($author) {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return string 
     */
    public function getAuthor() {
        return $this->author;
    }

    /**
     * Set language
     *
     * @param string $language
     * @return Book
     */
    public function setLanguage($language) {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language
     *
     * @return string 
     */
    public function getLanguage() {
        return $this->language;
    }

    /**
     * Set publisher
     *
     * @param string $publisher
     * @return Book
     */
    public function setPublisher($publisher) {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * Get publisher
     *
     * @return string 
     */
    public function getPublisher() {
        return $this->publisher;
    }

    /**
     * Set summary
     *
     * @param string $summary
     * @return Book
     */
    public function setSummary($summary) {
        $this->summary = $summary;

        return $this;
    }

    /**
     * Get summary
     *
     * @return string 
     */
    public function getSummary() {
        return $this->summary;
    }

    /**
     * Set brochure
     *
     * @param string $brochure
     * @return Book
     */
    public function setBrochure($brochure) {
        $this->brochure = $brochure;

        return $this;
    }

    /**
     * Get brochure
     *
     * @return string 
     */
    public function getBrochure() {
        return $this->brochure;
    }

}
