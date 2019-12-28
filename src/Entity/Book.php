<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", length=255)
     */
    private $isbn;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inverseBy="book")
     */
    private $category;

    /**
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * @ORM\Column(type="integer", default=0)
     */
    private $qty;

     /**
     * @ORM\Column(type="integer", default=1)
     */
    private $active;

     /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrderItem", mappedBy="category")
     */
    private $order_item;

    public function getId(): ?int
    {
        return $this->id;
    }
}
