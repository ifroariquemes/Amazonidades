<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PontuacaoRepository")
 */
class Pontuacao
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cla")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cla;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Membro")
     * @ORM\JoinTable(name="pontuacao_membro",
     *      joinColumns={@ORM\JoinColumn(name="pontuacao_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="membro_cpf", referencedColumnName="cpf")}
     *      )
     */
    private $membros;

    /**
     * @ORM\Column(type="text")
     */
    private $descricao;

    /**
     * @ORM\Column(type="integer")
     */
    private $pontos;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Campanha", inversedBy="pontuacoes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $campanha;

    public function __construct()
    {
        $this->membros = new ArrayCollection();        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCla(): ?Cla
    {
        return $this->cla;
    }

    public function setCla(?Cla $cla): self
    {
        $this->cla = $cla;

        return $this;
    }

    /**
     * @return Collection|Membro[]
     */
    public function getMembros(): Collection
    {
        return $this->membros;
    }

    public function addMembro(Membro $membro): self
    {
        if (!$this->membros->contains($membro)) {
            $this->membros[] = $membro;
        }

        return $this;
    }

    public function removeMembro(Membro $membro): self
    {
        if ($this->membros->contains($membro)) {
            $this->membros->removeElement($membro);
        }

        return $this;
    }

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getPontos(): ?int
    {
        return $this->pontos;
    }

    public function setPontos(int $pontos): self
    {
        $this->pontos = $pontos;

        return $this;
    }

    public function getCampanha(): ?Campanha
    {
        return $this->campanha;
    }

    public function setCampanha(?Campanha $campanha): self
    {
        $this->campanha = $campanha;

        return $this;
    }
}
