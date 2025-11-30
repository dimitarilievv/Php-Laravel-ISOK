<?php
    session_start();
    require 'jwt_helper.php';
    if(!isset($_SESSION['jwt']) || !decodeJWT($_SESSION['jwt'])){
        header('Location: pages/auth/login.php');
    }
    include "database/db_connection.php";
    $db=connectDatabase();
    $query= "SELECT * FROM cameras";
    $result=$db->query($query);
?>

<body>
<div>
    <h1>Cameras List</h1>
    <a href="pages/create.php">
        Add Camera
    </a>
    <a href="handlers/auth/logout_handler.php">
        Logout
    </a>
</div>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Location</th>
        <th>Date</th>
        <th>Price</th>
        <th>Type</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if ($result): ?>
        <?php while ($camera = $result->fetchArray(SQLITE3_ASSOC)): ?>
            <tr>
                <td><?php echo htmlspecialchars($camera['id']) ?></td>
                <td><?php echo htmlspecialchars($camera['name']) ?></td>
                <td><?php echo htmlspecialchars($camera['location'])?></td>
                <td><?php echo htmlspecialchars($camera['date'])?></td>
                <td><?php echo htmlspecialchars($camera['price'])?></td>
                <td><?php echo htmlspecialchars($camera['type']) ?></td>
                <td>
                    <form action="handlers/delete_handler.php" method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($camera['id'])?>">
                        <button type="submit">Delete</button>
                    </form>
                    <form action="pages/edit.php" method="GET" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($camera['id'])?>">
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">No cameras found.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>
</body>