
<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from customers where id=$from";
    $query = mysqli_query($conn, $sql);
    $sql1 = mysqli_fetch_array($query); // returns array or output of user from which the amount is to be transferred.

    $sql = "SELECT * from customers where id=$to";
    $query = mysqli_query($conn, $sql);
    $sql2 = mysqli_fetch_array($query);



    // constraint to check input of negative value by user
    if (($amount) < 0) {
        echo "<script> alert('Amount cannot be less than zero') </script>";
    }



    // constraint to check insufficient balance.
    else if ($amount > $sql1['balance']) {
        echo "<script> alert('The amount you want to transfer, is out of your balance. Please try again.') </script>";
    }



    // constraint to check zero values
    else if ($amount == 0) {

        echo "<script> alert('Oops zero value cannot be transfered') </script>";
    } else {

        // deducting amount from sender's account
        $newbalance = $sql1['balance'] - $amount;
        $sql = "UPDATE customers set balance=$newbalance where id=$from";
        mysqli_query($conn, $sql);


        // adding amount to reciever's account
        $newbalance = $sql2['balance'] + $amount;
        $sql = "UPDATE customers set balance=$newbalance where id=$to";
        mysqli_query($conn, $sql);

        $sender = $sql1['name'];
        $receiver = $sql2['name'];
        $sql = "INSERT INTO transfers(`sender`, `receiver`, `amount`) VALUES ('$sender','$receiver','$amount')";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo "<script> alert('Transaction Successful');
                                     window.location='transaction_history.php';
                           </script>";
        }

        $newbalance = 0;
        $amount = 0;
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
    <link rel="stylesheet" type="text/css" href="selectuser.css">
</head>

<body>
    <div class="container">
        <nav>
            <a href="index.php">Home</a>
            <a href="transfer_money.php">Transfer Money</a>
            <a href="transaction_history.php">Transaction History</a>
        </nav>
    
        <header>
            <h1>Transfer Money</h1>
        </header>

        <main>
            <!--
            <?php
            include 'config.php';
            $sid = $_GET['id'];
            $sql = "SELECT * FROM  customers where id=$sid";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                echo "Error : " . $sql . "<br>" . mysqli_error($conn);
            }
            $rows = mysqli_fetch_assoc($result);
            ?>
            -->

            <form method="post" name="tcredit"><br>
                <table>
                    <tr>
                        <th>Account No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Balance</th>
                    </tr>
                    <tr>
                        <td><?php echo $rows['id'] ?></td>
                        <td><?php echo $rows['name'] ?></td>
                        <td><?php echo $rows['email'] ?></td>
                        <td><?php echo $rows['balance'] ?></td>
                    </tr>
                </table>
                <br><br><br>
                
                <div class="section">
                    <label><b>Transfer To:</b></label>
                    <select name="to" required>
                        <option value="" disabled selected>Choose</option>
                        
                        <?php
                        include 'config.php';
                        $sid = $_GET['id'];
                        $sql = "SELECT * FROM customers where id!=$sid";
                        $result = mysqli_query($conn, $sql);
                        if (!$result) {
                            echo "Error " . $sql . "<br>" . mysqli_error($conn);
                        }
                        while ($rows = mysqli_fetch_assoc($result)) {
                        ?>
                            <option value="<?php echo $rows['id']; ?>">

                                <?php echo $rows['name']; ?> (Balance:
                                <?php echo $rows['balance']; ?> )
                            </option>
                        <?php
                        }
                        ?>
                    
                    </select>
                    <br><br><br>
                    <label><b>Amount:</b></label>
                    <input type="number" name="amount" required>
                    <br><br>
                    <button name="submit" type="submit">Transfer</button>
                </div>
            </form>
        </main>

        <footer></footer>
</body>



</html>