<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Newsletter Email</title>
</head>
<body>
    <h2>Hi {{ !empty($detail['admin'])? $detail['admin']: 'Esteemed Subscriber' }}</h2>
    <p>{{ $detail['body'] }}</p>
</body>
</html>