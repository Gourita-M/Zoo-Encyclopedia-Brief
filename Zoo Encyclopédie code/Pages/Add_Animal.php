<?php 
   include "./sql_connect.php";

   if(isset($_POST['adde'])){

    $addname = $_POST["addname"];
    $addfood = $_POST["addfood"];
    $addimg = $_POST["addimage"];
    $addhabitat = $_POST["addhabitat"];
    $habitatIDconvert = 2;


    echo $addname, $addfood, $addimg, $addhabitat;

    $addingtosql = "INSERT INTO animals 
                    (Name_animals, Alimentaire_type, Image_Animals, HabitatID)
                    VALUES ('$addname', '$addfood', '$addimg', '$habitatIDconvert');
                    ";
    $connection->query($addingtosql);
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
      <button class="bg-white text-green-600 px-3 py-1 rounded">Home</button>
      <button class="bg-white text-green-600 px-3 py-1 rounded">Add Animal</button>
      <button class="bg-white text-green-600 px-3 py-1 rounded">Add Habitat</button>
    </div>
  </nav>
  <div class="min-h-screen flex items-center justify-center bg-gray-100">
  <div class="bg-white p-8 rounded shadow-md w-full max-w-lg">
    <h2 class="text-xl font-bold mb-4">Add New Animal</h2>
    <form method="POST" class="bg-white p-8 rounded w-full max-w-lg">
      <label class="block mb-2">Animal Name:</label>
      <input type="text" name="addname" class="w-full border px-2 py-1 mb-3" required>

      <label class="block mb-2">Food Type:</label>
      <input type="text" name="addfood" class="w-full border px-2 py-1 mb-3" required>

      <label class="block mb-2">Image URL:</label>
      <input type="text" name="addimage" class="w-full border px-2 py-1 mb-3" required>

      <label class="block mb-2 font-semibold">Habitat ID:</label>
        <select class="p-2 border rounded" name="habita">
            <option value="">All Habitats</option>
            <option value="Savannah">Savannah</option>
            <option value="Jungle">Jungle</option>
            <option value="Desert">Desert</option>
            <option value="Ocean">Ocean</option>
        </select>
      <div class="flex justify-end gap-2 mt-4">
        <button id="closepop" type="button" class="px-3 py-1 bg-gray-400 text-white rounded">Cancel</button>
        <button type="submit" name="adde" class="px-3 py-1 bg-blue-500 text-white rounded">Save</button>
      </div>
    </form>
  </div>
</div>
<footer class="bg-green-600 text-white p-4 text-center">
    2025 Zoo Management System
  </footer>
</body>
</html>