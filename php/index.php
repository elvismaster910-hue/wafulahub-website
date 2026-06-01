<?php
include("./includes/connect.php");

// RUN ONLY AFTER FORM SUBMISSION
if(isset($_POST['save'])){

    // SAFE INPUT HANDLING
    $product_id = $_POST['product_id'] ?? '';
    $product_name = $_POST['product_name'] ?? '';
    $product_rating = $_POST['product_rating'] ?? 0;
    $product_count = $_POST['product_count'] ?? 0;
    $product_price = $_POST['product_price'] ?? 0;

    // CHECK IMAGE UPLOAD
    if(isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0){

        $tmp_name = $_FILES['product_image']['tmp_name'];

        // READ IMAGE CONTENT
        $image = file_get_contents($tmp_name);

        // ESCAPE FOR MYSQL
        $image = mysqli_real_escape_string($conn, $image);

        // INSERT QUERY
        $sql = "INSERT INTO products
        (product_id, image, name, stars, rating_count, price)
        VALUES
        ('$product_id', '$image', '$product_name', '$product_rating', '$product_count', '$product_price')";

        $result = mysqli_query($conn, $sql);

        if($result){
            echo "<script>alert('Product added successfully!');</script>";
        }else{
            echo "<script>alert('Database insert failed!');</script>";
        }

    }else{
        echo "<script>alert('Please upload an image');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Form</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:Arial;
        }

        body{
            background:#f4f6f9;
            display:flex;
            justify-content:center;
            align-items:center;
            min-height:100vh;
        }

        .container{
            width:420px;
            background:white;
            padding:30px;
            border-radius:15px;
            box-shadow:0 5px 15px rgba(0,0,0,0.2);
        }

        h2{
            text-align:center;
            margin-bottom:20px;
        }

        .input-group{
            margin-bottom:15px;
        }

        label{
            display:block;
            margin-bottom:6px;
            font-weight:bold;
        }

        input{
            width:100%;
            padding:10px;
            border:1px solid #ccc;
            border-radius:8px;
        }

        .btn{
            width:100%;
            padding:12px;
            background:#007bff;
            color:white;
            border:none;
            border-radius:8px;
            font-size:16px;
            cursor:pointer;
        }

        .btn:hover{
            background:#0056b3;
        }

        img{
            width:150px;
            margin-top:10px;
            display:none;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>Add Product</h2>

    <form method="POST" enctype="multipart/form-data">

        <div class="input-group">
            <label>Product ID</label>
            <input type="text" name="product_id" required>
        </div>

        <div class="input-group">
            <label>Product Name</label>
            <input type="text" name="product_name" required>
        </div>

        <div class="input-group">
            <label>Rating Stars</label>
            <input type="number" step="0.1" name="product_rating" required>
        </div>

        <div class="input-group">
            <label>Rating Count</label>
            <input type="number" name="product_count" required>
        </div>

        <div class="input-group">
            <label>Price</label>
            <input type="number" name="product_price" required>
        </div>

        <div class="input-group">
            <label>Product Image</label>
            <input type="file" name="product_image" accept="image/*" required>
        </div>

        <button type="submit" name="save" class="btn">
            Save Product
        </button>

    </form>

</div>

</body>
</html>