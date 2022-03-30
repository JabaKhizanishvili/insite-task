<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</head>

<body>
    <?php
    include 'main.php';
    ?>
    <h2>orders json return</h2>
    <?php

    $json_array = json_encode($orders_data);
    echo  $json_array;

    // foreach ($orders_data as  $value) {
    //     echo $value['user_id'] . "<br>";
    // }

    ?>


    <h5>go to cart page <a href="getUserCart.php">click</a></h5>


    <div class="container mt-5 pt-5">
        <p>add product to cart</p>
        <form action="addProductInCart.php" class="w-25 shadow p-3 mb-5 bg-body rounded" method="post">
            <span>id</span>
            <select class="form-select" name='id'>
                <?php
                foreach ($products_data as  $value) {
                    echo "<option>" . $value['product_id'] . "</option>";
                }
                ?>
            </select>
            <input type="submit" class="btn btn-primary" value="Submit">
        </form>
    </div>
    <div class="container mt-5 pt-5">
        <p>remove from cart</p>
        <form action="removeProductFromCart.php" class="w-25 shadow p-3 mb-5 bg-body rounded" method="post">
            <span>id</span>
            <select class="form-select" name='id'>
                <?php
                foreach ($products_data as  $value) {
                    echo "<option>" . $value['product_id'] . "</option>";
                }
                ?>
            </select>
            <input type="submit" class="btn btn-primary" value="Submit">
        </form>
    </div>
    <div class="container mt-5 pt-5">
        <p>change quantity</p>
        <form action="setCartProductQuantity.php" class="w-25 shadow p-3 mb-5 bg-body rounded" method="post">
            <span>id</span>
            <select class="form-select" name='id'>
                <?php
                foreach ($products_data as  $value) {
                    echo "<option>" . $value['product_id'] . "</option>";
                }
                ?>
            </select>
            <p>quantity</p>
            <input type="number" name='quantity' class='form-control'>
            <input type="submit" class="btn btn-primary" value="Submit">
        </form>
    </div>


    <!-- price discount -->
    <?php

    $count = 0;
    $sale = false;

    for ($i = 0; $i < count($orders_data); $i++) {
        for ($j = 0; $j < count($productGroupItem); $j++) {
            if ($orders_data[$i]['product_id'] == $productGroupItem[$j]['product_id']) {
                $count++;
                $orders_data[$i]['sale'] = true;
                if ($count == count($productGroupItem)) {
                    $sale = true;
                }
            }
        }
    }

    if ($sale) {
        foreach ($orders_data as $val) {
            print_r($val);
            echo '<br>';
        }
    }

    $a = array_filter($orders_data, function ($el) {
        if (isset($el['sale'])) {
            return $el['sale'] == 1;
        }
    });


    // getMinQuantity

    function minQuantityFunction()
    {
        global $a;
        foreach ($a as $v) {
            $MinValue = array();
            array_push($MinValue, $v['quantity']);
            print_r($MinValue);
        }
        // echo "<br> minValue : " . min($MinValue);
        return $MinValue;
    }


    $minval = min(minQuantityFunction());
    echo "<br> minValue : " . $minval;

    echo "<br>";
    $prosaleValue = $saleVal[0]['discount'];
    echo $prosaleValue;

    ?>



</body>

</html>