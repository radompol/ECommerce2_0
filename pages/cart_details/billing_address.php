<?php
require_once '../../connection.php';
session_start();
$userID = $_SESSION['id_user'];

$fetchCart = $conn->prepare('SELECT a.* from customers a where a.customer_id=?');
$fetchCart->execute([$userID]);
$fetchCart_ = $fetchCart->fetch();
?>
<label for="">Billing Address</label>
<div class="row">
    <div class="col-6">
        <label for="">
            Address
        </label>
        <input value="<?php echo $fetchCart_['customer_address'] ?>" type="text" class="form-control">
        <label for="">
            Country
        </label>
        <input value="<?php echo $fetchCart_['customer_country'] ?>" type="text" class="form-control">
    </div>
    <div class="col-6">
        <label for="">
            Municipality/City
        </label>
        <input value="<?php echo $fetchCart_['customer_city'] ?>" type="text" class="form-control">

        <label for="">
            Contact
        </label>
        <input value="<?php echo $fetchCart_['customer_contact'] ?>" type="text" class="form-control">
    </div>
</div>

<div class="modal-footer">
    <button onclick="fetchCartDetails_()" type="button" class="btn btn-secondary">Cancel</button>
    <button onclick="confirmCheckOut()" style="background-color: black;" type="button" class="btn  text-white">Checkout</button>
</div>

<script>
    function confirmCheckOut() {
        let answer = confirm("Are you sure to checkout now?");
        if (answer) {
            // toBillingAddress()
            $.post("pages/cart_details/actions/check_out.php", {

                },
                function(data) {
                    alert(data)
                    fetchCartDetails_()
                }
            );
        }
    }
</script>