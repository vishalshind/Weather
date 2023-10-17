<!DOCTYPE html>
<html>
<head>
    <title>Delete City Data</title>
    <link rel="stylesheet" href="styles/style_delete.css">                  
</head>
<body>
    <h1>Delete City Data</h1>
    
    <form method="POST" action="deleteController.php">
        <label for="deleteCity">City to Delete:</label>
        <input type="text" id="deleteCity" name="deleteCity" required>
        <button type="submit">Delete</button>
    </form>
</body>
</html>
