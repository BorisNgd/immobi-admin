<?php

namespace App\Entity;

use App\Repository\HouseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\DomCrawler\Image;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=HouseRepository::class)
 * @Vich\Uploadable()
 */
class House
{

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reference;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $area;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
     */
    private $picture;

    /**
     *  @Vich\UploadableField(mapping="post_thumbnails" , fileNameProperty="picture")
     */
    private $pictureFile;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberOfRoom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfBedRoom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfKitchenRoom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfLivingRoom;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $visitorCount;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $entranceCondition;

    /**
     * @ORM\Column(type="boolean")
     */
    private $promote;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToOne(targetEntity=HouseType::class, inversedBy="houses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $HouseType;

    /**
     * @ORM\ManyToOne(targetEntity=Location::class, inversedBy="houses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Location;

    /**
     * @ORM\OneToMany(targetEntity=Attachment::class, mappedBy="house" , cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $Attachments;

    /**
     * @ORM\OneToMany(targetEntity=Booking::class, mappedBy="House")
     */
    private $bookings;

    public function __construct()
    {
        $this->numberOfRoom = 1;
        $this->numberOfBedRoom = 1;
        $this->numberOfKitchenRoom = 0;
        $this->numberOfLivingRoom = 0;
        $this->visitorCount = 0;
        $this->status = 0;
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
        $this->Attachments = new ArrayCollection();
        $this->bookings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getArea(): ?float
    {
        return $this->area;
    }

    public function setArea(?float $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNumberOfRoom(): ?int
    {
        return $this->numberOfRoom;
    }

    public function setNumberOfRoom(int $numberOfRoom): self
    {
        $this->numberOfRoom = $numberOfRoom;

        return $this;
    }

    public function getNumberOfBedRoom(): ?int
    {
        return $this->numberOfBedRoom;
    }

    public function setNumberOfBedRoom(?int $numberOfBedRoom): self
    {
        $this->numberOfBedRoom = $numberOfBedRoom;

        return $this;
    }

    public function getNumberOfKitchenRoom(): ?int
    {
        return $this->numberOfKitchenRoom;
    }

    public function setNumberOfKitchenRoom(?int $numberOfKitchenRoom): self
    {
        $this->numberOfKitchenRoom = $numberOfKitchenRoom;

        return $this;
    }

    public function getNumberOfLivingRoom(): ?int
    {
        return $this->numberOfLivingRoom;
    }

    public function setNumberOfLivingRoom(?int $numberOfLivingRoom): self
    {
        $this->numberOfLivingRoom = $numberOfLivingRoom;

        return $this;
    }

    public function getVisitorCount(): ?int
    {
        return $this->visitorCount;
    }

    public function setVisitorCount(?int $visitorCount): self
    {
        $this->visitorCount = $visitorCount;

        return $this;
    }

    public function getEntranceCondition(): ?string
    {
        return $this->entranceCondition;
    }

    public function setEntranceCondition(?string $entranceCondition): self
    {
        $this->entranceCondition = $entranceCondition;

        return $this;
    }

    public function getPromote(): ?bool
    {
        return $this->promote;
    }

    public function setPromote(bool $promote): self
    {
        $this->promote = $promote;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getHouseType(): ?HouseType
    {
        return $this->HouseType;
    }

    public function setHouseType(?HouseType $HouseType): self
    {
        $this->HouseType = $HouseType;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->Location;
    }

    public function setLocation(?Location $Location): self
    {
        $this->Location = $Location;

        return $this;
    }

    /**
     * @return Collection|Attachment[]
     */
    public function getAttachments(): Collection
    {
        return $this->Attachments;
    }

    public function addAttachment(Attachment $attachment): self
    {
        if (!$this->Attachments->contains($attachment)) {
            $this->Attachments[] = $attachment;
            $attachment->setHouse($this);
        }

        return $this;
    }

    public function removeAttachment(Attachment $attachment): self
    {
        if ($this->Attachments->contains($attachment)) {
            $this->Attachments->removeElement($attachment);
            // set the owning side to null (unless already changed)
            if ($attachment->getHouse() === $this) {
                $attachment->setHouse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Booking[]
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setHouse($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->contains($booking)) {
            $this->bookings->removeElement($booking);
            // set the owning side to null (unless already changed)
            if ($booking->getHouse() === $this) {
                $booking->setHouse(null);
            }
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPictureFile()
    {
        return $this->pictureFile;
    }

    /**
     * @param mixed $pictureFile
     * @throws \Exception
     */
    public function setPictureFile(?File $pictureFile): void
    {
        $this->pictureFile = $pictureFile;
        if ($pictureFile){
            $this->updatedAt = new \DateTime();
        }
    }


}
