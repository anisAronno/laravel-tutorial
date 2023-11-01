<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mail</title>
</head>
<body>
    <h1>Hi, {{$order['receiver']}}</h1> 
    <h2>Order Amount: {{$order['amount']}}</h2>
    <h2>Order Product: {{$order['product']}}</h2>
    <p>Your Address: {{$order['address']}}</p>
</body>
</html>