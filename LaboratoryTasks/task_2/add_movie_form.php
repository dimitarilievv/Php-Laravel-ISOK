<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Movie</title>
</head>
<body>
<form action="add_movie.php" method="POST">
    <label for="title">Title:</label>
    <input type="text" name="title" id="title" required>
    <br />
    <label for="genre">Genre:</label>
    <input type="text" name="genre" id="genre" required>
    <br />
    <label for="release_year">Release year:</label>
    <input type="number" name="release_year" id="release_year" required>
    <br />
    <button type="submit">Add Movie</button>
</form>
</body>
</html>
