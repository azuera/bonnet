<?php
namespace Service;
use Model\Produit;

class ProduitFactory
{
public function  create( array $produitData):Produit{
    $produit = new Produit();
    $produit->setIndex($produitData['produit_index']);
    $produit->setNom($produitData['produit_nom']);
    $produit->setPrix($produitData['produit_prix']);
    $produit->setImg($produitData['produit_img']);
    $produit->setDesc($produitData['produit_desc']);
    $produit->setMaterials([$produitData['material_name']]);
    $produit->setSizes([$produitData['size_name']]);
    return  $produit;
}
}