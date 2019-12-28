<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    private $first_name;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    private $last_name;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    private $email;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    private $address_line_1;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    private $address_line_2;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    private $city;

    /**
     * @ORM\Column(type="text", length=255, nullable=true)
     */
    private $note;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $gross_total;

    /**
     * @ORM\Column(type="float",options={"default":0})
     */
    private $discount;

    /**
     * @ORM\Column(type="float",options={"default":0})
     */
    private $coupon_discount;

    /**
     * @ORM\Column(type="float",options={"default":0})
     */
    private $net_total;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\OrderItem", mappedBy="order")
     */
    private $order_item;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Coupon", inversedBy="order")
     */
    private $coupon;

    public function __construct()
    {
        $this->order_item = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefNo(): ?string
    {
        return $this->ref_no;
    }

    public function setRefNo(string $ref_no): self
    {
        $this->ref_no = $ref_no;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAddressLine1(): ?string
    {
        return $this->address_line_1;
    }

    public function setAddressLine1(string $address_line_1): self
    {
        $this->address_line_1 = $address_line_1;

        return $this;
    }

    public function getAddressLine2(): ?string
    {
        return $this->address_line_2;
    }

    public function setAddressLine2(string $address_line_2): self
    {
        $this->address_line_2 = $address_line_2;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): self
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @return Collection|OrderItem[]
     */
    public function getOrderItem(): Collection
    {
        return $this->order_item;
    }

    public function addOrderItem(OrderItem $orderItem): self
    {
        if (!$this->order_item->contains($orderItem)) {
            $this->order_item[] = $orderItem;
            $orderItem->setOrder($this);
        }

        return $this;
    }

    public function removeOrderItem(OrderItem $orderItem): self
    {
        if ($this->order_item->contains($orderItem)) {
            $this->order_item->removeElement($orderItem);
            // set the owning side to null (unless already changed)
            if ($orderItem->getOrder() === $this) {
                $orderItem->setOrder(null);
            }
        }

        return $this;
    }

    public function getCoupon(): ?Coupon
    {
        return $this->coupon;
    }

    public function setCoupon(?Coupon $coupon): self
    {
        $this->coupon = $coupon;

        return $this;
    }

    public function getGrossTotal(): ?float
    {
        return $this->gross_total;
    }

    public function setGrossTotal(float $gross_total): self
    {
        $this->gross_total = $gross_total;

        return $this;
    }

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function setDiscount(float $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getCouponDiscount(): ?float
    {
        return $this->coupon_discount;
    }

    public function setCouponDiscount(float $coupon_discount): self
    {
        $this->coupon_discount = $coupon_discount;

        return $this;
    }

    public function getNetTotal(): ?float
    {
        return $this->net_total;
    }

    public function setNetTotal(float $net_total): self
    {
        $this->net_total = $net_total;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
