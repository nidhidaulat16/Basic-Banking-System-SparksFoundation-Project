<!Doctype html>
<html ang="en">
    
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Transfer Money by Sparks Bank</title>
        <link rel="stylesheet" href="transfer_money.css" type="text/css">
    </head>


    <body>
        <div class="container">
            <nav>
                <a href="index.php">Home</a>
                <a href="transfer_money.php">Transfer Money</a>
                <a href="transaction_history.php">Transaction History</a>
            </nav>
        
            <header>
                <h1>Customer Details</h1>
            </header>

            <main>
                <table style="width:100%">
                    <tr>
                      <th>Account No.</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Balance</th>
                      <th>Operation</th>
                    </tr>
                      <?php
                         include 'config.php';
                         $sql = "SELECT * FROM customers";
                         $result = mysqli_query($conn, $sql);
                         
                         while ($rows = mysqli_fetch_assoc($result)) {
                       ?>
                    <tr>
                        <td><?php echo $rows['id'] ?></td>
                        <td><?php echo $rows['name'] ?></td>
                        <td><?php echo $rows['email'] ?></td>
                        <td><?php echo $rows['balance'] ?></td>
                        <td><a href="selectuser.php?id= <?php echo $rows['id']; ?>"> <button type="button" class="btn">Transfer</button></a></td>       
                    </tr>
                      <?php
                            }
                       ?>
                </table>
            </main>
        </div>

        
    </body>
    
</html>
