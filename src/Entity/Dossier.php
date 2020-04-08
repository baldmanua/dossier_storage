<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DossierRepository")
 * @ORM\Table(name="dossiers")
 */
class Dossier
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Dossier type should not be blank")
     * @Assert\Length(max="255", maxMessage="Dossier type too long")
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, name="first_name")
     * @Assert\NotBlank(message="First name should not be blank")
     * @Assert\Length(max="255", maxMessage="First name too long")
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255, name="second_name")
     * @Assert\NotBlank(message="Second name should not be blank")
     * @Assert\Length(max="255", maxMessage="Second name too long")
     */
    private $secondName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Address should not be blank")
     * @Assert\Length(max="255", maxMessage="Address too long")
     */
    private $address;

    /**
     * @ORM\Column(type="bigint", length=16, name="card_number")
     * @Assert\NotBlank(message="Card bumber should not be blank")
     * @Assert\Length(min="16", max="16", exactMessage="Card bumber should contain 16 digits")
     * @Assert\Type("digit", message="Card bumber should contain digits only")
     */
    private $cardNumber;

    /**
     * @ORM\Column(type="smallint", length=4)
     * @Assert\NotBlank(message="CVV Code should not be blank")
     * @Assert\Length(max="4", maxMessage="The CVV code should be 4 digits max")
     */
    private $cvv;

    /**
     * @ORM\Column(type="boolean", options={"default": false})
     */
    private $deleted = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getSecondName(): ?string
    {
        return $this->secondName;
    }

    public function setSecondName(string $secondName): self
    {
        $this->secondName = $secondName;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCardNumber(): ?string
    {
        return $this->cardNumber;
    }

    public function setCardNumber(string $cardNumber): self
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    public function getCvv(): ?int
    {
        return $this->cvv;
    }

    public function setCvv(int $cvv): self
    {
        $this->cvv = $cvv;

        return $this;
    }

    public function getDeleted(): ?bool
    {
        return $this->deleted;
    }

    public function setDeleted(int $deleted): self
    {
        $this->deleted = $deleted;

        return $this;
    }
}
