<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<?php $produits=[ [
                    "nom"=>"bonnet en laine",
                    "prix"=>10,
                    "desc"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis a leo diam. Quisque lorem orci, accumsan quis dolor sed, gravida."
                    ],
                    [
                        "nom"=>"bonnet en laine bio",
                        "prix"=>14,
                        "desc"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis a leo diam. Quisque lorem orci, accumsan quis dolor sed, gravida."
                    ],
    [
        "nom"=>"bonnet en laine et cachemir",
        "prix"=>20,
        "desc"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis a leo diam. Quisque lorem orci, accumsan quis dolor sed, gravida."
    ],
    [
        "nom"=>"bonnet arc en ciel",
        "prix"=>12,
        "desc"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis a leo diam. Quisque lorem orci, accumsan quis dolor sed, gravida."
    ],
];

function tva(float $prixTTC): float
{
    return $prixTTC/1.2;
}
function displaybonnet(int$id,array $produits) :void{
<tr>
        <td><?php  echo $produit['nom']; ?> </td>
<td <?php  if ($produit['prix']<=12){
    echo "class='green'";}
else {echo"class='red'";}?> >
    <?php echo $prix; ?></td>
<td><?php echo number_format(tva($prix), 2, ',', ' '); ?></td>
<td><?php  echo $produit['desc']; ?></td>

</tr>
}
?>

<table>
    <tr>
        <th>
            produit
        </th>
        <th>
            prix
        </th>
        <th>
            desc
        </th>
    </tr>


            <?php foreach ($produits as $index => $produit){
                $prix = $produit['prix'];

                displaybonnet($index,$produit);


        } ?>

</table>

</body>
</html>