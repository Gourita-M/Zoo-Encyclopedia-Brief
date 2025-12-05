<?php
include "./sql_connect.php";
$id = $_GET['id'];
echo $id;

$getname = "SELECT * FROM habitat
            WHERE habitat.IdHabitat = '$id';";
$habiname = $connection->query($getname);
if(isset($_POST['confirm'])){
    $delethabi = "DELETE FROM habitat 
                  WHERE habitat.IdHAbitat = '$id';";
    $connection->query($delethabi);
    header("Location: ./Add_habitat.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zoo Encyclopedia</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <nav class="bg-green-600 text-white p-4 flex justify-between items-center">
    <h1 class="text-xl font-bold">Zoo Encyclopedia</h1>
    <div class="space-x-4">
      <a href="../index.php" class="bg-white text-green-600 px-3 py-1 rounded">
        Home
      </a>
    </div>
  </nav>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md text-center">
        <h2 class="text-2xl font-bold mb-4">Delete Animal</h2>
        <p class="mb-6">Are you sure you want to delete 
            <span class="font-semibold">
            <?php 
               foreach($habiname as $habi){
                echo $habi['NomHab'];
                };
             ?>
            </span>?</p>
        <form method="post" class="flex justify-center gap-4">
            <button type="submit" name="confirm" class="bg-red-500 text-white px-6 py-2 rounded hover:bg-red-600">Yes, Delete</button>
            <a href="./Add_habitat.php" class="bg-gray-300 text-gray-800 px-6 py-2 rounded hover:bg-gray-400">Cancel</a>
        </form>
    </div>
</div>
<footer class="bg-green-600 text-white p-4 text-center">
    2025 Zoo Management System
  </footer>
</body>
</html>

