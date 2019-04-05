<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Output escaping</h1>
<?

// Display the result of submitting the form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Hello, " . htmlspecialchars($_POST['name']);
}

?>

<form method="post">
    <div>
        <label for="name">Your name</label>
        <input type="text" id="name" name="name" autofocus>
    </div>
    <div>
        <button type="submit">Submit</button>
    </div>
</form>
</body>
</html>