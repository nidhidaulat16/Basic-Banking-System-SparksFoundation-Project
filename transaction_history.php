<!Doctype html>
<html ang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Transaction History by Sparks Bank</title>
        <link rel="stylesheet" href="transaction_history.css">
    </head>


    <body>
        <nav>
            <a href="index.php">Home</a>
            <a href="transfer_money.php">Transfer Money</a>
            <a href="transaction_history.php">Transaction History</a>
        </nav>

        <h1>Transaction History</h1>
        <div class="section">
            <table>
                    <tr>
                        <th>Sr.No</S></th>
                        <th>Sender</th>
                        <th>Receiver</th>
                        <th>Amount</th>
                        <th>Date & Time</th>
                    </tr>

                    <?php
                    include 'config.php';

                    $sql = "SELECT * FROM `transfers`";
                    $query = mysqli_query($conn, $sql);

                    while ($rows = mysqli_fetch_assoc($query)) {

                    ?>
                        <tr>
                            <td><?php echo $rows['sr_no']; ?></td>
                            <td><?php echo $rows['sender']; ?></td>
                            <td><?php echo $rows['receiver']; ?></td>
                            <td><?php echo $rows['amount']; ?></td>
                            <td><?php echo $rows['date_time']; ?></td>
                        </tr>

                    <?php
                    }

                    ?>

            </table>
        </div>
    </body>
    
</html>