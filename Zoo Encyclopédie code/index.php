<?php
   include "./Pages/sql_connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Zoo Encyclopedia</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">
  <nav class="bg-green-600 text-white p-4 flex justify-between items-center">
    <h1 class="text-xl font-bold">Zoo Encyclopedia</h1>
    <div class="space-x-4">
      <button class="bg-white text-green-600 px-3 py-1 rounded">Home</button>
      <button class="bg-white text-green-600 px-3 py-1 rounded">
        <a href="./Pages/Add_Animal.php">Add Animal</a>
      </button>
      <button class="bg-white text-green-600 px-3 py-1 rounded">Add Habitat</button>
    </div>
  </nav>
  <section class="p-6">
    <h2 class="text-lg font-semibold mb-2">Filters</h2>
    <form method="POST" class="flex gap-4">
      <select name="habittt" class="p-2 border rounded">
        <option value="">All Habitats</option>
        <option value="Savannah">Savannah</option>
        <option value="Jungle">Jungle</option>
        <option value="Desert">Desert</option>
        <option value="Ocean">Ocean</option>
      </select>
      <select name="type" class="p-2 border rounded">
        <option value="">All Alimentaire Type</option>
        <option value="Carnivore">Carnivore</option>
        <option value="Herbivore">Herbivore</option>
        <option value="Omnivore">Omnivore</option>
      </select>
      <button type="submit" name="filterr" class="bg-green-600 text-white px-4 py-2 rounded">Filter</button>
</form>
  </section>
  <section class="p-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    <?php
    if(isset($_POST['filterr'])){
    $habiii = $_POST['habittt'];
    $type = $_POST['type'];
    $filtering = "SELECT Animals.ID_Animals,
            Animals.Name_Animals,
            Animals.Alimentaire_type,
            Animals.Image_Animals,
            Habitat.NomHab
            FROM Animals , Habitat 
            WHERE Animals.HabitatID = Habitat.IdHabitat 
            and Habitat.NomHab = '$habiii'
            and Alimentaire_type = '$type';";
    $fil = $connection->query($filtering);
    while($show = $fil->fetch_assoc()) {
        echo "
        <div class='bg-white shadow rounded overflow-hidden'>
            <img src='{$show["Image_Animals"]}' class='w-full h-48 object-cover'>
            <div class='p-4'>
                <h3 class='text-lg font-bold'>{$show["Name_Animals"]}</h3>
                <p>Food: {$show["Alimentaire_type"]} </p>
                <div class='mt-4 flex gap-2'>
                    <a href='./Pages/edit.php?id={$show["ID_Animals"]}' 
                    class='bg-yellow-400 text-white px-3 py-1 rounded'>Edit</a>
                    <a href='./Pages/delete.php?id={$show["ID_Animals"]}'
                    class='bg-red-500 text-white px-3 py-1 rounded'>Delete</a>
                </div>
            </div>
        </div>
        ";
    }
    } else {
      $showall = "SELECT * FROM Animals;";
      $fil = $connection->query($showall);
      while($show = $fil->fetch_assoc()) {
        echo "
        <div class='bg-white shadow rounded overflow-hidden'>
            <img src='{$show["Image_Animals"]}' class='w-full h-48 object-cover'>
            <div class='p-4'>
                <h3 class='text-lg font-bold'>{$show["Name_Animals"]}</h3>
                <p>Food: {$show["Alimentaire_type"]} </p>
                <div class='mt-4 flex gap-2'>
                    <a href='./Pages/edit.php?id={$show["ID_Animals"]}' 
                    class='bg-yellow-400 text-white px-3 py-1 rounded'>Edit</a>
                    <a href='./Pages/delete.php?id={$show["ID_Animals"]}'
                    class='bg-red-500 text-white px-3 py-1 rounded'>Delete</a>
                </div>
            </div>
        </div>
        ";
      }
      echo "test";
    }
    ?>
</section>
  <section class="p-6">
    <h2 class="text-lg font-semibold mb-2">Animal Statistics</h2>
    <div class="bg-white shadow rounded p-4 h-64 flex items-center justify-center">
      <span class="text-gray-400">Graph Placeholder</span>
    </div>
  </section>
  <footer class="bg-green-600 text-white p-4 text-center">
    2025 Zoo Management System
  </footer>
</body>
</html>