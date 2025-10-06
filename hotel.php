<!DOCTYPE html>
<html>
<head>
    <title>Restaurant Online Ordering</title>
    <style>
        body {font-family: Arial; margin: 20px; background: #f8f8f8;}
        h2 {color: #333;}
        form {background: #fff; padding: 15px; border: 1px solid #ccc; width: 300px; margin-bottom: 20px;}
        input, button {margin: 5px 0; padding: 8px; width: 95%;}
        table {border-collapse: collapse; width: 100%; background: #fff;}
        th, td {border: 1px solid #ccc; padding: 8px; text-align: center;}
        th {background: #eee;}
        .btn {padding: 5px 10px; border: none; cursor: pointer;}
        .update {background: #4CAF50; color: #fff;}
        .delete {background: #f44336; color: #fff;}
    </style>
</head>
<body>

<h2>Place Your Order</h2>
<form method="POST" action="order.php">
    Dish Name:<br>
    <input type="text" name="dish" required><br>
    Price:<br>
    <input type="number" name="price" step="0.01" required><br>
    Quantity:<br>
    <input type="number" name="quantity" required><br>
    <button type="submit" name="add">Add Order</button>
</form>

<h2>Current Orders</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Dish</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Action</th>
    </tr>
    <?php
    $conn=new mysqli("localhost","root","","restaurant");
    $result=$conn->query("SELECT * FROM orders");
    $final=0;
    while($row=$result->fetch_assoc()){
        $total=$row['price']*$row['quantity'];
        $final+=$total;
        echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['dish']}</td>
        <td>{$row['price']}</td>
        <td>
            <form method='POST' action='order.php'>
                <input type='hidden' name='id' value='{$row['id']}'>
                <input type='number' name='quantity' value='{$row['quantity']}' style='width:60px'>
                <button type='submit' name='update' class='btn update'>Update</button>
            </form>
        </td>
        <td>$total</td>
        <td>
            <a href='order.php?delete={$row['id']}' class='btn delete'>Delete</a>
        </td>
        </tr>";
    }
    echo "<tr><td colspan='4'><b>Final Cost</b></td><td colspan='2'><b>$final</b></td></tr>";
    ?>
</table>

</body>
</html>
