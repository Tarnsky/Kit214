<?php
include ('db_conn.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Only legal items</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">

                <div class="card mt-5">
                    <div class="card-header text-center">
                        <h4>Buy Only Legal items please</h4>
                    </div>
                    <div class="card-body">

                        <form action="" method="GET">
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="text" name="itemsearch" value="<?php if(isset($_GET['itemsearch'])){echo $_GET['itemsearch'];} ?>" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </form>

                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <?php 
                  
                                   global $mysqli;

                                    if(isset($_GET['itemsearch']))
                                    {
                                        $itemsearch = $_GET['itemsearch'];

                                        $query = "SELECT * FROM tb_items WHERE itemname='$itemsearch' ";
                                        $result = $mysqli->query($query);

                                        if($row_cnt = mysqli_num_rows($result) >= 1)
                                        {
                                            foreach($result as $row)
                                            {
                                                ?>
                                                <div class="form-group mb-3">
                                                    <label for="">Name</label>
                                                    <input type="text" value="<?= $row['itemname']; ?>" class="form-control">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="">Item price</label>
                                                    <input type="text" value="<?= $row['item_price']; ?>" class="form-control">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="">Seller</label>
                                                    <input type="text" value="<?= $row['seller']; ?>" class="form-control">
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label for="">link to store</label>
                                                    <input type="text" value="Onlylegalitems/<?=$row['IP_address']; ?>/itemlist.php" class="form-control">
                                                </div>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            echo "No Item Found";
                                        }
                                    }

                                ?>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php    
$xmlstr = <<<XML
<?xml version="1.0" encoding="UTF-8"?>
<itemlist>
  <seller>
  <title>Seller - Paul</title>
   <items>
      <itemid>1</itemid>
      <itemname>Puppy</itemname>
      <price>5</price>
   </items>
   <items>
      <itemid>2</itemid>
      <itemname>Kitten</itemname>
      <price>10</price>
   </items>
   <items>
      <itemid>3</itemid>
      <itemname>Dragon</itemname>
      <price>15</price>
   </items>
   <items>
      <itemid>4</itemid>
      <itemname>BakingSoda</itemname>
      <price>15</price>
   </items>
   </seller>
</itemlist>
XML;
?>

<?php

$itemlist = new SimpleXMLElement($xmlstr);
echo $itemlist->seller->title, ' ';
echo "<br>";
foreach ($itemlist->seller->items as $items) {
   echo $items->itemname, " $", $items->price, PHP_EOL;
   echo "<br>";
}

?>
<?php
      echo "<br>";
      $session_id = 1;
      $query = "SELECT * FROM tb_users WHERE user_id = '$session_id'";
      $result=$mysqli->query($query);
      while($row = mysqli_fetch_array($result)){
        ?>
        <!-- Tab contents for account balance -->
        <div>
          <table>
            <tr>
              <td>
                Order item
              </td>
            </tr>
          </table>
            <th>
                <form action="itemlist.php" method="post">
                    <select name="selecteditem[]">
                        <option value="5">Puppy</option>
                        <option value="10">Kitten</option>
                        <option value="15">Dragon</option>
                        <option value="15">BakingSoda</option>
                    </select>
                    <input type="submit" name="order" value="Order" />
                </form>
            </th>
        </div>
      </div>
    </div>
    <?php

    if(isset($_POST['order'])) {
        foreach ($_POST['selecteditem'] as $selectitem)
        {
            $result =$mysqli->query("SELECT account_balance FROM tb_users WHERE user_id = '$session_id'")->fetch_object()->account_balance;
            if((int)$result < (int)$selecteditem){
              die ("transaction failed please go back a page");
              header('Location: itemlist.php');
            }
            else {
              $new_bal=(int)$result-(int)$selectitem;
              $mysqli->query("UPDATE tb_users SET account_balance = $new_bal WHERE user_id = '$session_id'");
              header('Location: itemlist.php');
            }
        }

    }
    ?>
<?php } ?> 

<?php
      echo "<br>";
      $session_id = 1;
      $query = "SELECT * FROM tb_users WHERE user_id = '$session_id'";
      $result=$mysqli->query($query);
      while($row = mysqli_fetch_array($result)){
        ?>
        <!-- Tab contents for account balance -->
        <div>
          <table>
            <tr>
              <td>
                Current Balance:
              </td>
              <td>
              $<?php echo $row['account_balance'];?>
              </td>
            </tr>
          </table>
            <th>
                <form action="itemlist.php" method="post">
                    <select name="selected[]">
                        <option value="5">$5</option>
                        <option value="10">$10</option>
                        <option value="20">$20</option>
                        <option value="50">$50</option>
                        <option value="100">$100</option>
                    </select>
                    <input type="submit" name="submit" value="ADD FUNDS" />
                </form>
            </th>
        </div>
      </div>
    </div>
    <?php
    if(isset($_POST['submit'])) {
        foreach ($_POST['selected'] as $select)
        {
            $result =$mysqli->query("SELECT account_balance FROM tb_users WHERE user_id = '$session_id'")->fetch_object()->account_balance;
            $new_bal=(int)$result+(int)$select;
            $mysqli->query("UPDATE tb_users SET account_balance = $new_bal WHERE user_id = '$session_id'");
            header('Location: itemlist.php');
        }

    }
    ?>
<?php } ?> 
</html>