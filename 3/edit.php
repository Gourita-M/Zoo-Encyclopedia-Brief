<?php
/*
include "db_connection.php";

if(isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM Animals WHERE ID_Animals = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

if(isset($_POST['update'])) {
    $name = $_POST['name'];
    $food = $_POST['food'];
    $image = $_POST['image'];
    $habitat = $_POST['habitat'];

    $sql = "UPDATE Animals SET 
                Name_Animals='$name', 
                Alimentaire_type='$food', 
                Image_Animals='$image', 
                HabitatID='$habitat' 
            WHERE ID_Animals = $id";

    $conn->query($sql);
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
    <form method="post" class="bg-white p-8 rounded shadow-md w-full max-w-lg">
        <h2 class="text-2xl font-bold mb-6">Edit Animal</h2>

        <label class="block mb-2 font-semibold">Name:</label>
        <input type="text" name="name" value="<?php echo $row['Name_Animals']; ?>" class="border p-2 w-full mb-4 rounded">

        <label class="block mb-2 font-semibold">Food Type:</label>
        <input type="text" name="food" value="<?php echo $row['Alimentaire_type']; ?>" class="border p-2 w-full mb-4 rounded">

        <label class="block mb-2 font-semibold">Image URL:</label>
        <input type="text" name="image" value="<?php echo $row['Image_Animals']; ?>" class="border p-2 w-full mb-4 rounded">

        <label class="block mb-2 font-semibold">Habitat ID:</label>
        <input type="number" name="habitat" value="<?php echo $row['HabitatID']; ?>" class="border p-2 w-full mb-6 rounded">

        <div class="flex justify-between">
            <button type="submit" name="update" class="bg-yellow-400 text-white px-6 py-2 rounded hover:bg-yellow-500">Update</button>
            <a href="./index.php" class="bg-gray-300 text-gray-800 px-6 py-2 rounded hover:bg-gray-400">Cancel</a>
        </div>
    </form>
</div>
