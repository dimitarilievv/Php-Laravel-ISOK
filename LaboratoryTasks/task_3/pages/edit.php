<?php
include '../database/db_connection.php';
session_start();
require '../jwt_helper.php';
if(!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])){
    header('Location: ../pages/auth/login.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $db=connectDatabase();
    $id = intval($_GET['id']);
    $query = "SELECT * FROM cameras WHERE id=:id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $result=$stmt->execute();
    $camera = $result->fetchArray(SQLITE3_ASSOC);
    $db->close();
}
?>

    <h1>Update Camera</h1>

<?php if ($camera): ?>
    <form action="../handlers/edit_handler.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($camera['id']) ?>">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($camera['name']) ?>" required>
        <br>
        <label for="location">Location:</label>
        <input type="text" name="location" id="location" value="<?php echo htmlspecialchars($camera['location']) ?>" required>
        <br>
        <label for="date">Date:</label>
        <input type="date" name="date" id="date" value="<?php echo htmlspecialchars($camera['date']) ?>" required>
        <br>
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" value="<?php echo htmlspecialchars($camera['price']) ?>" required>
        <br>
        <label for="type">Camera type</label>
        <select name="type" id="type">
            <option value="internal" <?php echo htmlspecialchars($camera['type']) ==='internal' ? 'selected=true': '' ?>>internal</option>
            <option value="external" <?php echo htmlspecialchars($camera['type']) ==='external' ? 'selected=true': '' ?>>external</option>
        </select>
        <br/>
        <button type="submit">Update Camera</button>
    </form>
<?php else: ?>
    <p>Camera not found.</p>
<?php endif; ?>