# bonnet

[//]: # ('SELECT *)

[//]: # (FROM produit)

[//]: # (INNER JOIN produit_material ON produit.produit_index = produit_material.id_produit)

[//]: # (INNER JOIN material ON material.material_id = produit_material.id_material)

[//]: # (INNER JOIN produit_size ON produit.produit_index = produit_size.id_size)

[//]: # (INNER JOIN size ON size.size_id = produit_size.id_size';)