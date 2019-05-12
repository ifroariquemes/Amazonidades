<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClaRepository")
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="cla_nome_unique", columns={"nome"})})
 * @Vich\Uploadable
 */
class Cla {

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $logo;

    /**
     * @Vich\UploadableField(mapping="cla_logos", fileNameProperty="logo")
     * @var File
     */
    private $logoArquivo;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descricao;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Membro", mappedBy="cla")
     * @ORM\OrderBy({"nome" = "ASC"})
     */
    private $membros;

    public function __construct() {
        $this->membros = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getNome(): ?string {
        return $this->nome;
    }

    public function setNome(string $nome): self {
        $this->nome = $nome;

        return $this;
    }

    public function getLogo() {
        return $this->logo;
    }

    public function setLogo($logo): self {
        $this->logo = $logo;

        return $this;
    }

    public function getDescricao(): ?string {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): self {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * @return Collection|Membro[]
     */
    public function getMembros(): Collection {
        return $this->membros;
    }

    public function addMembro(Membro $membro): self {
        if (!$this->membros->contains($membro)) {
            $this->membros[] = $membro;
            $membro->setCla($this);
        }

        return $this;
    }

    public function removeMembro(Membro $membro): self {
        if ($this->membros->contains($membro)) {
            $this->membros->removeElement($membro);
            // set the owning side to null (unless already changed)
            if ($membro->getCla() === $this) {
                $membro->setCla(null);
            }
        }

        return $this;
    }

    function getLogoArquivo() {
        return $this->logoArquivo;
    }

    function setLogoArquivo($logoArquivo) {
        $this->logoArquivo = $logoArquivo;
        return $this;
    }
    
    public function __toString() {
        return $this->nome;
    }

}
