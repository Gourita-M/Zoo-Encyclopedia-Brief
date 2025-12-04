<?php
include "./sql_connect.php";

$id = $_GET['id'];

echo "Your ID is ".$id;

$sql = "SELECT * FROM Animals WHERE ID_Animals = $id";
$result = $connection->query($sql);
$row = $result->fetch_assoc();
if (isset($_POST['update'])) {
    $Newname = $_POST["name"];
    $newfoodtype = $_POST["food"];
    $newimg = $_POST["image"];
    $newhati = $_POST["habita"];
    $update_sql = "UPDATE Animals SET 
                    Name_Animals='$Newname', 
                    Alimentaire_type='$newfoodtype', 
                    Image_Animals='$newimg' 
                   WHERE ID_Animals = $id";
    
    $connection->query($update_sql);
    header("Location: ../index.php");
    exit();
echo $Newname, $newfoodtype, $newimg, $newhati;
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
      <button class="bg-white text-green-600 px-3 py-1 rounded">
        <a href="../index.php">Home</a>
      </button>
      <button class="bg-white text-green-600 px-3 py-1 rounded">Add Animal</button>
      <button class="bg-white text-green-600 px-3 py-1 rounded">Add Habitat</button>
    </div>
  </nav>
      <div class="min-h-screen flex items-center justify-center bg-gray-100">
    <form method="post" class="bg-white p-8 rounded shadow-md w-full max-w-lg">
        <h2 class="text-2xl font-bold mb-6">Edit Animal</h2>
        <label class="block mb-2 font-semibold">Name:</label>
        <input type="text" name="name" value="<?php echo $row['Name_Animals']; ?>" class="border p-2 w-full mb-4 rounded">

        <label class="block mb-2 font-semibold">Food Type:</label>
        <input type="text" name="food" value="<?php echo $row['Alimentaire_type']; ?>" class="border p-2 w-full mb-4 rounded">
        <div>
            <label class="block mb-2 font-semibold">Image URL:</label>
            <input type="text" name="image" value="<?php echo $row['Image_Animals']; ?>" class="border p-2 w-[79%] mb-4 rounded">
             or
            <button class="p-2 bg-orange-300 rounded-lg">Upload</button>
        </div>
        <label class="block mb-2 font-semibold">Habitat ID:</label>
        <select class="p-2 border rounded" name="habita">
        <option value="">All Habitats</option>
        <option value="Savannah">Savannah</option>
        <option value="Jungle">Jungle</option>
        <option value="Desert">Desert</option>
        <option value="Ocean">Ocean</option>
      </select>

        <div class="flex justify-between">
            <button type="submit" name="update" class="bg-yellow-400 text-white px-6 py-2 rounded hover:bg-yellow-500">
               Update
            </button>
            <a href="../index.php" class="bg-gray-300 text-gray-800 px-6 py-2 rounded hover:bg-gray-400">Cancel</a>
        </div>
    </form>
</div>
<footer class="bg-green-600 text-white p-4 text-center">
    2025 Zoo Management System
  </footer>
</body>
</html>