<?php

class Produit{


    protected ?int $index ;
    protected ?string $nom;
    protected ?float $prix =0.0;
    protected ?string $desc;
    protected ?string $img;
	protected array $sizes=[];
	protected array $materials=[];

    public const AVAILABLE_SIZES = ['S', 'M', 'L', 'XL'];
    public const AVAILABLE_MATERIALS = ['laine', 'cachemire', 'soie', 'coton'];

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
    public function getAvailableMaterials()
    {
        return self::AVAILABLE_MATERIALS;
    }



	/**
	 * @return array
	 */
	public function getSizes(): array {
		return $this->sizes;
	}
	
	/**
	 * @param array $sizes 
	 * @return self
	 */
	public function setSizes(array $sizes): self {
		$this->sizes = $sizes;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getMaterials(): array {
		return $this->materials;
	}
	
	/**
	 * @param array $materials 
	 * @return self
	 */
	public function setMaterials(array $materials): self {
		$this->materials = $materials;
		return $this;
	}
	public function addSize(string $size):self{
		if(!in_array($size,self::AVAILABLE_SIZES)){
			return $this;
		}
		if(!in_array($size, $this->sizes)){
			$this->sizes[] = $size;
		}
		
		return $this;
	}
	public function removeSize(string $size):self{
		if(in_array($size, $this->sizes)){
			foreach($this->sizes as $key => $currentSize){
				if($currentSize ==$size){
					unset($this->sizes[$key]);
				}
				
			}
			
		}
		
		return $this;
	}
	public function addMaterial(string $material):self{
		if(!in_array($material,self::AVAILABLE_MATERIALS)){
			return $this;
		}
		if(!in_array($material, $this->materials)){
			$this->materials[] = $material;
		}
		
		return $this;
	}
	public function removeMaterial(string $material):self{
		if(in_array($material, $this->materials)){
			foreach($this->materials as $key => $currentmaterial){
				if($currentmaterial ==$material){
					unset($this->materials[$key]);
				}
				
			}
			
		}
		
		return $this;
	}
}
