<?php

    include('./sqlrequest.php');

    $amounterr = 0;
    if(isset($_POST['submit'])){
        if(empty($_POST['amount']) || !isset($_POST['recepient'])){
            $amounterr =  1;
        }else{
            $amounterr = 0;
        }
        if($amounterr == 0){
            $sender = $_POST['sender'];
            $amount = $_POST['amount']; 
            $recepient = $_POST['recepient'];
            $myquery = $dbh->prepare("SELECT CBALANCE FROM customerdetails WHERE CNAME = :send");
            $myquery->execute([':send' => $sender]);
            $sarr = $myquery->fetchAll(PDO::FETCH_ASSOC);
            $myquery1 = $dbh->prepare("SELECT CBALANCE FROM customerdetails WHERE CNAME = :rece");
            $myquery1->execute([':rece' => $recepient]);
            $rarr = $myquery1->fetchAll(PDO::FETCH_ASSOC);
            $samount = $sarr[0]['CBALANCE'] - $amount;
            if($samount > 0){
                $ramount = $rarr[0]['CBALANCE'] + $amount;
                $stmt1 = $dbh->prepare("UPDATE customerdetails SET CBALANCE = :sbal WHERE CNAME = :send");
                $stmt1->execute([':sbal' => $samount,':send' => $sender]);
                $stmt2 = $dbh->prepare("UPDATE customerdetails SET CBALANCE = :rbal WHERE CNAME = :rece");
                $stmt2->execute([':rbal' => $ramount,':rece' => $recepient]);
                header('location:transferfunds.php');
            }else{
                echo "<script>alert('Insufficient Balance')</script>";
            }
        }else{
            echo "<script>alert('Enter all the details')</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <?php include('header.php');?>
    <body style="background-color:#fcc761">
    <style>
        *{
            background-color: #fcc761;
        }
    </style>
    <div id="customer" class="container-fluid">
        <h1 class="text-center fw-bolder">Goodwill Banks</h1>
        <table class="table">
            <thead>
                <tr>
                <th scope="col" class="text-dark">Name</th>
                <th scope="col" class="text-dark">Email</th>
                <th scope="col" class="text-dark">Phone No.</th>
                <th scope="col" class="text-dark">Current Balance</th>
                <th scope="col" class="text-dark">Transact</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach($customers as $customer){?>
                    <td><?php echo $customer['CNAME']?></td>
                    <td><?php echo $customer['CEMAIL']?></td>
                    <td><?php echo $customer['CPHNO']?></td>
                    <td><?php echo $customer['CBALANCE']?></td>
                    <td><button id="<?php echo $customer['CNAME']?>" class="btn btn-success shadow-none">Transact</button></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <form class="text-center" action="customer.php" method="POST">
            <input id="sender" name="sender" value="" readonly>
            <input type="number" placeholder="Amount to be sent" min="0" name="amount" value="<?php $amount ?>"><br/>
            <select name="recepient">
                <option disabled selected>Select the recepient</option>
                <?php foreach($customers as $customer){?>
                <option><?php echo $customer['CNAME']?></option>
                <?php } ?>
            </select><br/>
            <input class="btn btn-success shadow-none" type="submit" value="Submit" name="submit" id="submit">
        </form>
    </div>
    <script>
    $(document).ready(function(){
        $("form").hide();
        $("button").click(function(){
            $("table").hide();
            $("#sender").val(this.id);
            $("form").show();
        })
    })
    </script>
    <?php include('footer.php');?>
