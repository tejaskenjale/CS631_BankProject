<?php

include_once 'config.php';
global $db;
global $path;
session_start();
//$uname = $_SESSION['username'];
$uname = "johntest11";
$firstname = $lastname = $getinfo = "";

//FUNCTION FOR GETUSER INFO 1ST BOX
function getuserinfo($uname, $db)
{
    $getinfo = "select ssn, acc_no, first_name, last_name from customer where uname ='" . $uname . "';";
    $result = $db->query($getinfo) or die(mysqli_error($db));
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $firstname = $row['first_name'];
            $lastname = $row['last_name'];
            $ssn = $row['ssn'];
            $acc_no = $row['acc_no'];
        }
    } else {
        echo "0 results";
    }

    return [$firstname, $lastname, $ssn, $acc_no];
}

$arr = getuserinfo($uname, $db);
$firstname = $arr[0];
$lastname = $arr[1];
$ssn = $arr[2];
$acc_no = $arr[3];


if(isset($_POST['cheq_deposit'])) {
    $sen_acc = $_POST['send_acc_no'];
    $rec_acc = $_POST['rec_acc_no'];
    $amo = $_POST['amount'];
    $send_bal_q = "select balance from account where acc_no ='" . $sen_acc . "';";
    $result = $db->query($send_bal_q) or die(mysqli_error($db));
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $sen_bal = $row['balance'];
        }
    } else {
        echo "0 results";
    }
    //echo "<script>alert(". $sen_bal .")</script>";
    $rec_bal_q = "select balance from account where acc_no ='" . $rec_acc . "';";
    $result = $db->query($rec_bal_q) or die(mysqli_error($db));
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            $rec_bal = $row['balance'];
        }
    } else {
        echo "0 results";
    }
    //echo "<script>alert(". $rec_bal .")</script>";
    if ($sen_bal > $amo) {
        $upd_sen_bal = $sen_bal - $amo;
        echo "<script>alert(" . $upd_sen_bal . ")</script>";
        $upd_rec_bal = $rec_bal + $amo;
        echo "<script>alert(" . $upd_rec_bal . ")</script>";
        $upd_sen_bal_q = "UPDATE account SET balance = '" . $upd_sen_bal . "' WHERE acc_no = " . $sen_acc . ";";
        $result = $db->query($upd_sen_bal_q) or die(mysqli_error($db));
        $upd_rec_bal_q = "UPDATE account SET balance = '" . $upd_rec_bal . "' WHERE acc_no = " . $rec_acc . ";";
        $result = $db->query($upd_rec_bal_q) or die(mysqli_error($db));
    } else {
        echo '<script>alert("Cheque Bounced")</script>';
    }
}

if(isset($_POST['depo_amo'])) {

    $depo_bal = "select balance from account where uname ='" . $uname . "';";
    $result1 = $db->query($depo_bal) or die(mysqli_error($db));
    if ($result1->num_rows > 0) {
        // output data of each row
        while ($row = $result1->fetch_assoc()) {
            $depo_bal1 = $row['balance'];
        }
    } else {
        echo "0 results";
    }
    $amo1 = $_POST['dep_amount'];
    $upd_sen_bal1 = $depo_bal1 + $amo1;
    $upd_sen_bal_q1 = "UPDATE account SET balance = '" . $upd_sen_bal1 . "' WHERE uname = " . $uname . ";";
    $result = $db->query($upd_sen_bal_q1) or die(mysqli_error($db));
    echo '<script>alert("Amount Deposited")</script>';

}

if(isset($_POST['with_amo'])) {

    $with_bal = "select balance from account where uname ='" . $uname . "';";
    $result1 = $db->query($with_bal) or die(mysqli_error($db));
    if ($result1->num_rows > 0) {
        // output data of each row
        while ($row = $result1->fetch_assoc()) {
            $with_bal1 = $row['balance'];
        }
    } else {
        echo "0 results";
    }
    $amo2 = $_POST['with_amount'];
    $upd_sen_bal2 = $depo_bal1 - $amo1;
    $upd_sen_bal_q2 = "UPDATE account SET balance = '" . $upd_sen_bal2 . "' WHERE acc_no = " . $uname . ";";
    $result = $db->query($upd_sen_bal_q2) or die(mysqli_error($db));
    echo '<script>alert("Amount withdraw")</script>';

}


?>


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

        tr:nth-child(even) {
            background-color: #f2f2f2
        }
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
                <label for="account_no">Account No:</label>
                <label for="account_no"><?php echo $acc_no; ?></label>
                <br><br>

                &nbsp;&nbsp;&nbsp;
                <label for="SSN">SSN:</label>
                <label for="SSN"><?php echo $ssn; ?></label>
                <br><br>

                &nbsp;&nbsp;&nbsp;
                <label for="first_name">First Name:</label>
                <label for="first_name"><?php echo $firstname; ?></label>
                <br><br>

                &nbsp;&nbsp;&nbsp;
                <label for="last_name">Last Name:</label>
                <label for="last_name"><?php echo $lastname; ?></label>
                <br><br>
            </div>
        </div>


        <!--SECOND BOX-->

        <div class="card bg-light">

            <h3 align="center">Cheque Deposit</h3>
            <div class="card-body">

                <form method="post">
                    <label for="send_acc_no">Sender's Account No:</label>
                    <input type="text" class="form-control" name="send_acc_no" required="required"
                           value="<?php $new_acc; ?>">

                    &nbsp;
                    <label for="rec_acc_no">Receiver's Account No:</label>
                    <input type="text" class="form-control" name="rec_acc_no" required="required"
                           value="<?php $new_acc; ?>">

                    &nbsp;
                    <label for="amount">Amount:</label>
                    <input type="text" class="form-control" name="amount" required="required"
                           value="<?php $new_acc; ?>">

                    &nbsp;
                    <label for="signature">Signature:</label>
                    <input type="text" class="form-control" name="signature" required="required">

                    <br>

                    <input type="submit" name="cheq_deposit" value="Deposit Cheque" class="btn btn-success btn-block">
                </form>

            </div>
        </div>
    </div>
    <br/>


    <!--THIRD BOX-->
    <div class="card-deck">

        <div class="card bg-light" style="height: 400px">
            <div class="card-body text-center">
                <form method="post">
                    <h3>Deposit/Withdraw Money</h3>
                    <label for="amount">Amount to be Deposited:</label>
                    <input type="text" class="form-control" name="dep_amount" value="<?php $new_acc; ?>"><br>
                    <input type="submit" class="btn btn-success" name="depo_amo" value="Deposit amount"><br><br>
                    <label for="amount">Amount to be Withdraw:</label>
                    <input type="text" class="form-control" name="with_amount" value="<?php $new_acc; ?>"><br>
                    <input type="submit" class="btn btn-success" name="with_amo" value="Withdraw amount">
                </form>
            </div>
        </div>


        <!--FOURTH BOX-->
        <div class="card bg-light">
            <div class="card-body text-center">
                <h3>Print PassBook</h3>
                <input type="submit" class="btn btn-success" name="submit" value="Print PassBook">
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
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["type"] . "</td><td>" . $row["username"] . "</td><td>"
                                    . $row["password"] . "</td></tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "0 results";
                        }
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
