<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CampanhaRepository")
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="campanha_nome_unique", columns={"nome"})})
 */
class Campanha {

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
     * @ORM\Column(type="date")
     */
    private $dataInicio;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dataFim;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $descricao;

    /**
     * @ORM\Column(type="boolean")
     */
    private $visivel;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Pontuacao", mappedBy="campanha", orphanRemoval=true)
     */
    private $pontuacoes;

    /**
     * @ORM\Column(type="boolean")
     */
    private $encerrada;

    public function __construct() {
        $this->pontuacoes = new ArrayCollection();
        $this->encerrada = false;
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

    public function getDataInicio(): ?\DateTimeInterface {
        return $this->dataInicio;
    }

    public function setDataInicio(\DateTimeInterface $dataInicio): self {
        $this->dataInicio = $dataInicio;

        return $this;
    }

    public function getDataFim(): ?\DateTimeInterface {
        return $this->dataFim;
    }

    public function setDataFim(?\DateTimeInterface $dataFim): self {
        $this->dataFim = $dataFim;

        return $this;
    }

    public function getDescricao(): ?string {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): self {
        $this->descricao = $descricao;

        return $this;
    }

    public function getVisivel(): ?bool {
        return $this->visivel;
    }

    public function setVisivel(bool $visivel): self {
        $this->visivel = $visivel;

        return $this;
    }

    /**
     * @return Collection|Pontuacao[]
     */
    public function getPontuacoes(): Collection {
        return $this->pontuacoes;
    }

    public function addPontuaco(Pontuacao $pontuaco): self {
        if (!$this->pontuacoes->contains($pontuaco)) {
            $this->pontuacoes[] = $pontuaco;
            $pontuaco->setCampanha($this);
        }

        return $this;
    }

    public function removePontuaco(Pontuacao $pontuaco): self {
        if ($this->pontuacoes->contains($pontuaco)) {
            $this->pontuacoes->removeElement($pontuaco);
            // set the owning side to null (unless already changed)
            if ($pontuaco->getCampanha() === $this) {
                $pontuaco->setCampanha(null);
            }
        }

        return $this;
    }

    public function getEncerrada(): ?bool {
        return $this->encerrada;
    }

    public function setEncerrada(bool $encerrada): self {
        $this->encerrada = $encerrada;

        return $this;
    }

    public function __toString() {
        $encerrada = ($this->encerrada) ? '(ENCERRADA)' : '';
        return $this->nome . $encerrada;
    }

}
