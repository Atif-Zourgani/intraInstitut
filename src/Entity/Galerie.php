<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GalerieRepository")
 */
class Galerie
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $img;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $alt;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="galeries")
     */
    private $author;

    // creation de relation de table dans BDD
    //many yo one = cardinalité de 1 a 0
    //quand on fait un onetomany il faut faire un mappedby pour lier les deux tables
    //ensuite generer getteur et setteur et faire une doctrine migration
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Categorie", mappedBy="galerie")
     */
    private $categorie;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Protocole", mappedBy="galerie")
     */
    private $protocole;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\EventOpe", mappedBy="galerie")
     */
    private $event_ope;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="galerie")
     */
    private $produit;

    public function __construct()
    {
        $this->categorie = new ArrayCollection();
        $this->protocole = new ArrayCollection();
        $this->event_ope = new ArrayCollection();
        $this->produit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getImg(): ?string
    {
        return $this->img;
    }

    public function setImg(string $img): self
    {
        $this->img = $img;

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

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(?string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection|categorie[]
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(categorie $categorie): self
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie[] = $categorie;
            $categorie->setGalerie($this);
        }

        return $this;
    }

    public function removeCategorie(categorie $categorie): self
    {
        if ($this->categorie->contains($categorie)) {
            $this->categorie->removeElement($categorie);
            // set the owning side to null (unless already changed)
            if ($categorie->getGalerie() === $this) {
                $categorie->setGalerie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|protocole[]
     */
    public function getProtocole(): Collection
    {
        return $this->protocole;
    }

    public function addProtocole(protocole $protocole): self
    {
        if (!$this->protocole->contains($protocole)) {
            $this->protocole[] = $protocole;
            $protocole->setGalerie($this);
        }

        return $this;
    }

    public function removeProtocole(protocole $protocole): self
    {
        if ($this->protocole->contains($protocole)) {
            $this->protocole->removeElement($protocole);
            // set the owning side to null (unless already changed)
            if ($protocole->getGalerie() === $this) {
                $protocole->setGalerie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|eventope[]
     */
    public function getEventOpe(): Collection
    {
        return $this->event_ope;
    }

    public function addEventOpe(eventope $eventOpe): self
    {
        if (!$this->event_ope->contains($eventOpe)) {
            $this->event_ope[] = $eventOpe;
            $eventOpe->setGalerie($this);
        }

        return $this;
    }

    public function removeEventOpe(eventope $eventOpe): self
    {
        if ($this->event_ope->contains($eventOpe)) {
            $this->event_ope->removeElement($eventOpe);
            // set the owning side to null (unless already changed)
            if ($eventOpe->getGalerie() === $this) {
                $eventOpe->setGalerie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|product[]
     */
    public function getProduit(): Collection
    {
        return $this->produit;
    }

    public function addProduit(product $produit): self
    {
        if (!$this->produit->contains($produit)) {
            $this->produit[] = $produit;
            $produit->setGalerie($this);
        }

        return $this;
    }

    public function removeProduit(product $produit): self
    {
        if ($this->produit->contains($produit)) {
            $this->produit->removeElement($produit);
            // set the owning side to null (unless already changed)
            if ($produit->getGalerie() === $this) {
                $produit->setGalerie(null);
            }
        }

        return $this;
    }
}
