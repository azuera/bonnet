<?php

class BeanieFilter
{
    protected  ?int $id;


    protected  array $produits =[];
protected ?float $prixMini = null;

protected ?float $prixMax = null;
protected ?string $size = null;
protected ?string $material = null;

public function __construct(array $produits ,array $filters){
    if (!empty($filters['prix-mini'])) {
        $this->prixMini = floatval($filters['prix-mini']);
    }
    if (!empty($filters['prix-max'])) {
        $this->prixMax = floatval($filters['prix-max']);
    }
    if (!empty($filters['material'])) {
        $this->material = trim($filters['material']);
    }
    if (!empty($filters['size'])) {
        $this->size = trim($filters['size']);
    }

    $this->produits = $this->apply($produits);
}
    public function apply(array $produits): array
    {
        $prixMini = $this->getPrixMini();
        if ($prixMini) {
            $produits = array_filter($produits, function (Produit  $produit) use ($prixMini) {
                return $produit->getPrix() >= $prixMini;
            });
        }

        $prixMax = $this->getPrixMax();
        if ($prixMax) {
            $produits = array_filter($produits, function (Produit $produit) use ($prixMax) {
                return $produit->getPrix() <= $prixMax;
            });
        }

        $material = $this->getMaterial();
        if ($material) {
            $produits = array_filter($produits, function (Produit $produit) use ($material) {
                return in_array($material, $produit->getMaterials());
            });
        }

        $size = $this->getSize();
        if ($size) {
            $produits = array_filter($produits, function (Produit $produit) use ($size) {
                return in_array($size, $produit->getSizes());
            });
        }

        return $produits;
    }


    public function getId(): ?int
    {
        return $this->id;
    }


    public function setId(?int $id): void
    {
        $this->id = $id;
    }



    public function getPrixMini(): ?float
    {
        return $this->prixMini;
    }


    public function getPrixMax(): ?float
    {
        return $this->prixMax;
    }


    public function getSize(): ?string
    {
        return $this->size;
    }


    public function getMaterial(): ?string
    {
        return $this->material;
    }
    public function getResult(): array
    {
        return $this->produits;
    }


}