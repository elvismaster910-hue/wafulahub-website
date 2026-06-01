<?php
include("./includes/connect.php");

$products = [];

$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($result)){

    $image = base64_encode($row["image"]);
    $imageSrc = "data:image/jpeg;base64," . $image;

    $products[] = [
        "id" => $row["id"],
        "name" => $row["name"],
        "stars" => $row["stars"],
        "rating_count" => $row["rating_count"],
        "price" => $row["price"],
        "image" => $imageSrc
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Products</title>

<style>
body{
    font-family: Arial;
    background:#f5f5f5;
    margin:0;
}

/* GRID like Amazon */
.products-grid{
    display:grid;
    grid-template-columns: repeat(5, 1fr);
    gap:20px;
    padding:20px;
}

/* Product card */
.product{
    background:white;
    padding:15px;
    border-radius:10px;
    box-shadow:0 2px 6px rgba(0,0,0,0.1);
    display:flex;
    flex-direction:column;
    align-items:center;
}

/* Image */
.product img{
    width:100%;
    height:180px;
    object-fit:contain;
}

/* Name */
.name{
    font-size:14px;
    margin:10px 0;
    text-align:center;
    height:40px;
    overflow:hidden;
}

/* Stars */
.stars{
    color:#f5a623;
    font-size:14px;
    margin:5px 0;
}

/* Price */
.price{
    font-weight:bold;
    margin:5px 0;
}

/* Select */
select{
    padding:5px;
    margin:5px 0;
}

/* Button */
button{
    background:#ffd814;
    border:none;
    padding:8px 15px;
    border-radius:20px;
    cursor:pointer;
    width:100%;
}

button:hover{
    background:#f7ca00;
}
</style>

</head>
<body>

<div class="products-grid">

<?php foreach($products as $p): ?>

    <div class="product">

        <img src="<?= $p['image'] ?>">

        <div class="name"><?= $p['name'] ?></div>

        <div class="stars">
            ⭐ <?= $p['stars'] ?>
            (<?= $p['rating_count'] ?>)
        </div>

        <div class="price">
            KSh <?= $p['price'] ?>
        </div>

        <select>
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
        </select>

        <button>Add to Cart</button>

    </div>

<?php endforeach; ?>

</div>

</body>
</html>