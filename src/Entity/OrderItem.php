<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderItemRepository")
 */
class OrderItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Order", inverseBy="order_item")
     */
    private $order;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Book", inverseBy="order_item")
     */
    private $book;

     /**
     * @ORM\Column(type="integer")
     */
    private $qty;
    
     /**
     * @ORM\Column(type="float")
     */
    private $unit_price;
    
     /**
     * @ORM\Column(type="float")
     */
    private $total_price;

    public function getId(): ?int
    {
        return $this->id;
    }
}
