<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 */
class Order
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
    private $ref_no;

     /**
     * @ORM\Column(type="text", length=255)
     */
    private $first_name;

     /**
     * @ORM\Column(type="text", length=255)
     */
    private $last_name;

     /**
     * @ORM\Column(type="text", length=255)
     */
    private $phone;

     /**
     * @ORM\Column(type="text", length=255)
     */
    private $address_line_1;

     /**
     * @ORM\Column(type="text", length=255)
     */
    private $address_line_2;

     /**
     * @ORM\Column(type="text", length=255)
     */
    private $city;

     /**
     * @ORM\Column(type="text", length=255)
     */
    private $note;

    public function getId(): ?int
    {
        return $this->id;
    }
}
