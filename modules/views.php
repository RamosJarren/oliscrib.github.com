<?php
include 'dbconi.php';

$user_id = isset($_SESSION['userfullname']) ? $_SESSION['userfullname'] : 0;
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$sql = "SELECT * FROM bikes WHERE id = $id";
$result = mysqli_query($dbc, $sql);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    echo "Product not found.";
    exit;
}
?>

<section class="py-3 px-5">
    <div class="container">
        <div class="images">
            <img src="images/bayk1.png" alt="Product Image" />
        </div>
        <div class="product">
            <p><?php echo htmlspecialchars($product['part']); ?></p>
            <h1><?php echo htmlspecialchars($product['model']); ?></h1>
            <h2>₱<?php echo htmlspecialchars($product['price']); ?></h2>
            <p class="desc">The <?php echo htmlspecialchars($product['model']); ?> is a high-quality bike that offers excellent performance and durability.</p>
            <h1>Stock: <?php echo htmlspecialchars($product['stock']); ?> </h1>
            <div class="buttons">
                <?php if ($product['stock'] > 0): ?>
                    <button class="add" id="addCartBtn" data-product-id="<?php echo $product['id']; ?>" data-user-id="<?php echo $user_id; ?>">
                        Add to Cart
                    </button>
                <?php else: ?>
                    <button class="add" disabled>
                        Out of Stock
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    $("#addCartBtn").click(function() {
        var productId = $(this).data("product-id");
        var userId = $(this).data("user-id");
        var confirmation = confirm("Are you sure you want to add this item to your cart?");
        if (confirmation) {
            $.post("modules/cart_add.php", { product_id: productId, user_id: userId }, function(response) {
                alert(response);
            });
        }
    });
});
</script>

<style>
.container {
  position: relative;
  margin: auto;
  overflow: hidden;
  background: $white;
  border-radius: 10px;
}

p {
  font-size: 0.6em;
  color: #E6E4E0;
  letter-spacing: 1px;
}

h1 {
  font-size: 1.2em;
  color: #E6E4E0;
  margin-top: -5px;
}

h2 {
  color: #E6E4E0;
  margin-top: -5px;
}

.images img {
  width: 1000px;
  height: 600px; 
  object-fit: cover;
  margin-top: 20px;
  border-radius: 15px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
}

.product {
  position: absolute;
  width: 40%;
  height: auto;
  top: 10%;
  right: 60%;
  background: rgba(68, 68, 59, 0.8);
  padding: 15px; 
  border-radius: 10px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
  transition: transform 0.3s ease-in-out;
}

.product:hover {
  transform: translate(40px, -30px) scale(1.1);
  transition: transform 0.3s ease-in-out;
}

.desc {
  text-transform: none;
  letter-spacing: 0;
  margin-bottom: 17px;
  color: $dark;
  font-size: .7em;
  line-height: 1.6em;
  margin-right: 25px;
  text-align: justify;
}

button {
  background: darken($light, 10%);
  padding: 10px;
  display: inline-block;
  outline: 0;
  margin: -1px;
  border-radius: 10px;
  text-transform: uppercase;
  letter-spacing: 1px;
  width: 100%;
  border: 1px solid #A39594;
  background-color: #CEC4C2;
  cursor: pointer;
}

button:hover {
    box-shadow: 0 4px 15px rgba(255, 233, 191, 0.35);
}

.add {
  width: 67%;
}
</style>