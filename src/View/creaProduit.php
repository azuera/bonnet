<?php


use Model\Produit;

$sqlSelectMat="SELECT material_id, material_name FROM `material` ";
$statementSelectMat = $connection->query($sqlSelectMat);
$materials = $statementSelectMat->fetchAll(PDO::FETCH_ASSOC);

$sqlSelectSize="SELECT size_id, size_name FROM `size` ";
$statementSelectSize = $connection->query($sqlSelectSize);
$sizes = $statementSelectSize->fetchAll(PDO::FETCH_ASSOC);

if(!empty($_POST)){
    $produit =
        (new Produit())

            ->setNom($_POST['nom'])
            ->setPrix($_POST['Prix'])
            ->setDesc($_POST['desc'])
            ->setImg('https://picsum.photos/200');

    $sql = "INSERT INTO `produit`(
                      `produit_nom`,
                        `produit_prix`,
                      `produit_desc`,
                      `produit_img`,
                      `produit_size`,
                      `produit_material`) VALUES (:nom,
                                                  :prix,
                                                  :desc,
                                                  :img,
                                                  :size,
                                                  :material)";
    $sth = $connection->prepare($sql);
    $sth->bindValue(":nom", $produit->getNom(), PDO:: PARAM_STR);
    $sth->bindValue(":prix", $produit->getPrix(), PDO:: PARAM_INT);
    $sth->bindValue(":desc", $produit->getDesc(), PDO:: PARAM_STR);
    $sth->bindValue(":img", $produit->getImg(), PDO:: PARAM_STR);
    $sth->bindValue(":size", json_encode($produit->getSizes()), PDO:: PARAM_STR);
    $sth->bindValue(":material", json_encode($produit->getMaterials()), PDO:: PARAM_STR);
    $sth->execute();
    $id = $connection->lastInsertId();

    $jointureMat = "INSERT INTO `produit_material` (id_produit,id_material) VALUES (:id_produit,:id_material)";
    $statementMat = $connection->prepare($jointureMat);
    foreach ( $_POST['matiere'] as $idMat) {

        $statementMat->bindValue(":id_produit", $id, PDO:: PARAM_INT);
        $statementMat->bindValue(":id_material", $idMat, PDO:: PARAM_INT);
        $statementMat->execute();
    }

    $jointureSize = "INSERT INTO `produit_size`(`id_produit`, `id_size`) VALUES (:id_produit,:id_size)";
    $statementSize = $connection->prepare($jointureSize);
    foreach ($_POST["taille"] as $idSize){

        $statementSize->bindValue(":id_produit", $id, PDO:: PARAM_INT);
        $statementSize->bindValue(":id_size", $idSize, PDO:: PARAM_INT);
        $statementSize->execute();
    }
}








?>

<form action='' method="post">


    <div class="mb-3">
        <label for="nom" class="form-label">nom-Bonnet</label>
        <input type="text" id="nom" name="nom" class="form-control">
    </div>
    <div class="mb-3">
        <label for="Prix" class="form-label">Prix</label>
        <input type="number" class="form-control" id="Prix" name="Prix"  >
    </div>
    <div class="mb-3">
        <label for="desc" class="form-label">desc</label>
        <input type="text" class="form-control" id="desc" name="desc"  >
    </div>


    </div>
    <div class="mb-3">
        <label for="taille" class="form-label">taille</label>
        <select multiple id="taille" class="form-select" name="taille[]">
            <option>selectionner votre taille</option>
            <?php
            foreach ($sizes as  $size) {
                ?>
                <option value="<?= $size['size_id']; ?>"><?php echo $size['size_name']; ?></option>
                <?php
            }
            ?>
        </select>

    </div>
    <div class="mb-3">
        <label for="matiere"
               class="form-label">matiere
        </label>
        <select multiple  id="matiere" class="form-select" name="matiere[]">
            <option>selectionner votre matiere</option>
            <?php
            foreach ($materials as $material) {
                ?>
                <option value="<?= $material['material_id']; ?>"><?php echo $material['material_name']; ?></option>
                <?php
            }
            ?>
        </select>

    <button type="submit" class="btn btn-primary">Submit</button>

</form>
<?php
unset($_POST);
?>