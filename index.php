
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Card</title>



    <link href="css/mystyle.css" rel="stylesheet">


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>




    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            color: #588c7e;
            font-family: monospace;
            font-size: 25px;
            text-align: left;
        }
        th {
            background-color: #588c7e;
            color: white;
        }
        tr:nth-child(even) {background-color: #f2f2f2}
    </style>

</head>
<body>

<!--FIRST BOX-->

<div class="container">
    <br><br>
    <h2 align="center">Customer Welcome Page</h2><br><br>


    <div class="card-deck">
        <div class="card bg-light" style="height: 400px">
            <div class="card-body">
                <h3 align="center">Your Details</h3>
                <br>
                    &nbsp;&nbsp;&nbsp;
                    <label for="SSN">Account No:</label>
                            <label for="exampleInputPassword1">123</label>
                    <br><br>

                    &nbsp;&nbsp;&nbsp;
                    <label for="SSN">SSN:</label>
                            <label for="exampleInputPassword1">123</label>
                    <br><br>

                    &nbsp;&nbsp;&nbsp;
                    <label for="first_name">First Name:</label>
                            <label for="exampleInputPassword1">123</label>
                    <br><br>

                &nbsp;&nbsp;&nbsp;
                    <label for="last_name">Last Name:</label>
                            <label for="exampleInputPassword1">123</label>
                    <br><br>
            </div>
        </div>


<!--SECOND BOX-->

        <div class="card bg-light">
            <h3 align="center">Cheque Deposit</h3>
            <div class="card-body>
                    <label for="send_acc_no">Sender's Account No:</label>
                    <input type="text" class="form-control" name="send_acc_no" required="required" value="<?php $new_acc; ?>">

                    &nbsp;
                    <label for="rec_acc_no">Receiver's Account No:</label>
                    <input type="text" class="form-control" name="rec_acc_no" required="required" value="<?php $new_acc; ?>">

                    &nbsp;
                    <label for="amount">Amount:</label>
                    <input type="text" class="form-control" name="amount" required="required" value="<?php $new_acc; ?>">

                    &nbsp;
                    <label for="signature">Signature:</label>
                    <input type="text" class="form-control" name="signature" required="required">

                            <br>

                                <input type="submit" name="cheq_deposit" value="Deposit Cheque" class="btn btn-success btn-block">

            </div>
        </div>
    </div>
    <br/>


    <!--THIRD BOX-->


    <div class="card-deck">
        <div class="card bg-light" style="height: 400px">
            <div class="card-body text-center">
                <h3>Deposit/Withdraw Money</h3>

            </div>
        </div>


        <!--FOURTH BOX-->
        <div class="card bg-light">
            <div class="card-body text-center">
                <h3>Print PassBook</h3>
                <input type="submit" class="btn btn-success" name="submit" value="Print PassBook" >
                <br><br>
            <div class="container" style="overflow: scroll">
                <table>
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Password</th>
                    </tr>
                    <?php
                    $conn = mysqli_connect("localhost", "root", "Tejas@1998", "dmsd_db");
                    // Check connection
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    $sql = "SELECT type, username, password FROM login";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
// output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr><td>" . $row["type"]. "</td><td>" . $row["username"] . "</td><td>"
                                . $row["password"]. "</td></tr>";
                        }
                        echo "</table>";
                    } else { echo "0 results"; }
                    $conn->close();
                    ?>
                </table>


            </div>



            </div>
        </div>
    </div>
    <br><br>
</div>

</body>





</html>
