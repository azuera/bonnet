<?php
class Produit{
    protected ?int $index;
    protected ?string $nom;
    protected ?float $prix =0;
    protected ?string $desc;
    protected ?string $img;

    const AVAILABLE_SIZES = ['S', 'M', 'L', 'XL'];

	/**
	 * @return int|null
	 */
	public function getIndex(): ?int {
		return $this->index;
	}
	
	/**
	 * @param int|null $index 
	 * @return self
	 */
	public function setIndex(?int $index): self {
		$this->index = $index;
		return $this;
	}

	/**
	 * @return float|null
	 */
	public function getPrix(): ?float {
		return $this->prix;
	}
	
	/**
	 * @param float|null $prix 
	 * @return self
	 */
	public function setPrix(?float $prix): self {
		$this->prix = $prix;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getDesc(): ?string {
		return $this->desc;
	}
	
	/**
	 * @param string|null $desc 
	 * @return self
	 */
	public function setDesc(?string $desc): self {
		$this->desc = $desc;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getImg(): ?string {
		return $this->img;
	}
	
	/**
	 * @param string|null $img 
	 * @return self
	 */
	public function setImg(?string $img): self {
		$this->img = $img;
		return $this;
	}

	/**
	 * @return string|null
	 */
	public function getNom(): ?string {
		return $this->nom;
	}
	
	/**
	 * @param string|null $nom 
	 * @return self
	 */
	public function setNom(?string $nom): self {
		$this->nom = $nom;
		return $this;
	}
    public function getAvailableSizes()
    {
        return self::AVAILABLE_SIZES;
    }

}
