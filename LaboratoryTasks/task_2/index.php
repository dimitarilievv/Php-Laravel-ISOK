<?php

include 'db_connection.php';

$db = connectDatabase();

$search = '';
$genre = '';

$genresResult = $db->query("SELECT DISTINCT genre FROM movies");
$genres = [];
$query = "SELECT * FROM movies WHERE 1=1";
while ($row = $genresResult->fetchArray(SQLITE3_ASSOC)) {
    $genres[] = $row['genre'];
}

if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $search = trim($_GET['search']);
    $query .= " AND title LIKE :search";
}

if (isset($_GET['genre']) && !empty($_GET['genre'])) {
    $genre = $_GET['genre'];
    $query .= " AND genre = :genre";
}

$stmt = $db->prepare($query);

if (!empty($search)) {
    $stmt->bindValue(':search', '%' . $search . '%', SQLITE3_TEXT);
}

if (!empty($genre)) {
    $stmt->bindValue(':genre', $genre, SQLITE3_TEXT);
}

$result = $stmt->execute();

if (!$result) {
    die("Error fetching movies: " . $db->lastErrorMsg());
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Movies</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>
<body>
<div style="display: flex; align-items: center; justify-content: space-between">
    <h1>Movie List</h1>
    <a href="add_movie_form.php">
        Add new movie
    </a>
    <div>
        <form method="get" action="">
            <input type="text" name="search" placeholder="Search by title"
                   value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <select name="genre">
                <option value="">All genres</option>
                <?php foreach ($genres as $g): ?>
                    <option value="<?php echo htmlspecialchars($g); ?>"
                            <?php if ($g === $genre) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($g); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Search</button>
        </form>
    </div>
</div>
<table>
    <thead>
    <tr>
        <th>Title</th>
        <th>Genre</th>
        <th>Release Year</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if ($result): ?>
        <?php while ($movie = $result->fetchArray(SQLITE3_ASSOC)): ?>
            <tr>
                <td><?php echo htmlspecialchars($movie['title']); ?></td>
                <td><?php echo htmlspecialchars($movie['genre']); ?></td>
                <td><?php echo htmlspecialchars($movie['release_year']); ?></td>
                <td>
                    <form action="update_movie_form.php" method="get" style="display: inline;">
                        <input type="hidden" name="id" value="<?php echo $movie['id']; ?>">
                        <button type="submit">Update</button>
                    </form>
                    <form action="delete_movie.php" method="post" style="display: inline;">
                        <input type="hidden" name="id" value="<?php echo $movie['id']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">No movies found.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</body>
</html>