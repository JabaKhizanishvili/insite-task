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

  // $json_array = json_encode($orders_data);
  // echo  $json_array;



  ?>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">user id</th>
        <th scope="col">product id</th>
        <th scope="col">quantity</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($orders_data as $val) { ?>
        <tr>
          <th scope="row"><?= $val['id'] ?></th>
          <td><?= $val['user_id'] ?></td>
          <td><?= $val['product_id'] ?></td>
          <td><?= $val['quantity'] ?></td>
        </tr>
      <?php
      }
      ?>

    </tbody>
  </table>

  <h2>Back</h2>
  <a href="index.php">click</a>
  <br> <br>

  <?php
  $count = 0;
  $sale = false;
  $finalOutput = array();
  $fullPrice;
  $discountPrice;
  $discountPriceArr = array();


  for ($i = 0; $i < count($orders_data); $i++) {
    global $prosaleValue, $minval, $discountPrice;
    for ($j = 0; $j < count($productGroupItem); $j++) {
      if ($orders_data[$i]['product_id'] == $productGroupItem[$j]['product_id']) {
        $count++;
        $orders_data[$i]['sale'] = true;

        if ($count == count($productGroupItem)) {
          $sale = true;
        }
      } else {
      }
    }
  }

  if ($sale) {
    global $fullPrice, $discountPrice;
    foreach ($orders_data as $val) {
      print_r($val);

      $fullPrice += $val['quantity'] * $val['price'];

      $obj = [
        'product_id' => $val['product_id'],
        'quantity' => $val['quantity'],
        'price' => $val['price'],
      ];
      array_push($finalOutput, $obj);
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
      echo "<br>";
      print_r($MinValue);
    }
    // echo "<br> minValue : " . min($MinValue);
    return $MinValue;
  }



  $minval = min(minQuantityFunction());
  echo "<br> minValue : " . $minval;

  echo "<br>";
  $prosaleValue = $saleVal[0]['discount'];
  echo $prosaleValue . "<br>";

  function saledPrice()
  {
    global $orders_data, $prosaleValue, $minval, $discountPrice, $discountPriceArr;
    foreach ($orders_data as $value) {
      if (isset($value['sale'])) {
        $discountPrice = ($value['price'] * ((100 - $prosaleValue) / 100) * $minval) + (($value['quantity'] - $minval) * ($value['price']));
        array_push($discountPriceArr, $discountPrice);
      } else {
        $discountPrice = $value['price'] * $value['quantity'];
        array_push($discountPriceArr, $discountPrice);
      }
    }
  }

  saledPrice();
  echo  $fullPrice . " ";
  $fasdaklebuliFasi = array_sum($discountPriceArr);
  echo array_sum($discountPriceArr);
  $sabolooProcenti = (($fullPrice - $fasdaklebuliFasi) / 100) * 100;

  // jamuri fasdakleba
  $finalOutput['discount'] = $sabolooProcenti;
  echo "<br>" . $sabolooProcenti . "<br>";


  // ეს ის აუთფუთია რაც ტასკში გამოქ ბოლოს ჯსონში
  print_r(json_encode($finalOutput));

  ?>


</body>