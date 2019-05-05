<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MembroRepository")
 */
class Membro
{    

    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=11)
     */
    private $cpf;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nome;

    /**
     * @ORM\Column(type="date")
     */
    private $dataVinculo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Cla", inversedBy="membros")
     * @ORM\JoinColumn(nullable=false)
     */
    private $cla;
    
    public function __construct() {
        $this->dataVinculo = new \DateTime();
        
    }

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): self
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getDataVinculo(): ?\DateTimeInterface
    {
        return $this->dataVinculo;
    }

    public function setDataVinculo(?\DateTimeInterface $dataVinculo): self
    {
        $this->dataVinculo = $dataVinculo;

        return $this;
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
    
    public function __toString() {
        return $this->nome;
    }
}
