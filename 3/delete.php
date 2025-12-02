<?php
/*
include "db_connection.php";

if(isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT Name_Animals FROM Animals WHERE ID_Animals = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
} else {
    echo "No ID specified!";
    exit();
}

// If confirmed
if(isset($_POST['confirm'])) {
    $conn->query("DELETE FROM Animals WHERE ID_Animals = $id");
    header("Location: index.php");
    exit();
}
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zoo Encyclopedia</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md text-center">
        <h2 class="text-2xl font-bold mb-4">Delete Animal</h2>
        <p class="mb-6">Are you sure you want to delete <span class="font-semibold"><?php echo $row['Name_Animals']; ?></span>?</p>
        <form method="post" class="flex justify-center gap-4">
            <button type="submit" name="confirm" class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600">Yes, Delete</button>
            <a href="index.php" class="bg-gray-300 text-gray-800 px-6 py-2 rounded hover:bg-gray-400">Cancel</a>
        </form>
    </div>
</div>
