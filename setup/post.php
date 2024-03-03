<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Car Form</title>
</head>
<body>
    <h2>Post Car Form</h2>
    <form id="postCarForm" method="post" action="post_car.php">
        <label for="make">Make:</label>
        <input type="text" id="make" name="make" required><br><br>
        
        <label for="model">Model:</label>
        <input type="text" id="model" name="model" required><br><br>
        
        <label for="year">Year:</label>
        <input type="number" id="year" name="year" required><br><br>
        
        <label for="type">Type:</label>
        <input type="text" id="type" name="type" required><br><br>
        
        <label for="availability">Availability:</label>
        <input type="checkbox" id="availability" name="availability" value="1" checked><br><br>
        
        <label for="paymentAmount">Payment Amount:</label>
        <input type="number" id="paymentAmount" name="payment_amount" step="0.01" required><br><br>
        
        <button type="submit">Post Car</button>
    </form>
</body>
</html>
