<?php


$produitsFiltred  = new BeanieFilter($produits, $_POST);


?>
<form action='' method="post">
    <div class="mb-3">
        <label for="prix-mini" class="form-label">prix-mini</label>
        <input type="number" class="form-control" id="prix-mini" name="prix-mini" value="<?= $produitsFiltred->getPrixMini(); ?>">
    </div>
    <div class="mb-3">
        <label for="prix-max" class="form-label">prix-maxi</label>
        <input type="number" class="form-control" id="prix-max" name="prix-max" value="<?= $produitsFiltred->getPrixMax(); ?>">
    </div>
    <div class="mb-3">
        <label for="material" class="form-label">matiere</label>
        <select id="material" name="material">
            <option value=""> choisissez votre matiere</option>
            <?php
            foreach (Produit::AVAILABLE_MATERIALS as $value => $name) {
                ?>
                <option value="<?= $name; ?>" <?php if ($name == $produitsFiltred->getMaterial()) {
                    echo 'selected';
                } ?>><?php echo $name; ?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="size" class="form-label">size</label>
        <select id="size" name="size">
            <option value=""> choisissez votre taille</option>
            <?php
            foreach (Produit::AVAILABLE_SIZES as $value => $name) {
                ?>
                <option value="<?= $name; ?>" <?php if ($name == $produitsFiltred->getSize()) {
                    echo 'selected';
                } ?>><?php echo $name; ?></option>
                <?php
            }
            ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">GO ENVOI</button>
</form>

<table>
    <tr>
        <th>
            produit
        </th>
        <th>
            prix
        </th>
        <th>
            prix ht
        </th>
        <th>
            desc
        </th>

        <th>
            panier
        </th>
    </tr>


    <?php foreach ($produitsFiltred->getResult() as $produit) {
        displayBonnet($produit);
    } ?>

</table>

