<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$database   = "Zoo_Encyclopedia";


$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    echo "Connecting Failed";
}

echo "Connected successfully!";
$sql = "SELECT * FROM Animals";
$result = $connection->query($sql);

/*
while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["ID_Animals"] . "<br>";
        echo "Name: " . $row["Name_Animals"] . "<br>";
        echo "Food Type: " . $row["Alimentaire_type"] . "<br>";
        echo "Image: " . $row["Image_Animals"] . "<br>";
        echo "Habitat ID: " . $row["HabitatID"] . "<br>";
        echo "<hr>";
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
<body class="bg-gray-100 font-sans">

  <!-- Navigation Bar -->
  <nav class="bg-green-600 text-white p-4 flex justify-between items-center">
    <h1 class="text-xl font-bold">Zoo Encyclopedia</h1>
    <div class="space-x-4">
      <button class="bg-white text-green-600 px-3 py-1 rounded">Home</button>
      <button class="bg-white text-green-600 px-3 py-1 rounded">Add Animal</button>
      <button class="bg-white text-green-600 px-3 py-1 rounded">Add Habitat</button>
    </div>
  </nav>

  <!-- Filters -->
  <section class="p-6">
    <h2 class="text-lg font-semibold mb-2">Filters</h2>
    <div class="flex gap-4">
      <select class="p-2 border rounded">
        <option value="">All Habitats</option>
        <option value="Savannah">Savannah</option>
        <option value="Jungle">Jungle</option>
        <option value="Desert">Desert</option>
        <option value="Ocean">Ocean</option>
      </select>
      <select class="p-2 border rounded">
        <option value="">All Food Types</option>
        <option value="Carnivore">Carnivore</option>
        <option value="Herbivore">Herbivore</option>
        <option value="Omnivore">Omnivore</option>
      </select>
      <button class="bg-green-600 text-white px-4 py-2 rounded">Filter</button>
    </div>
  </section>

  <!-- Animal List -->
  <section class="p-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    <!-- Example Animal Card -->
      <?php
      while($row = $result->fetch_assoc()) {
        echo '
          <div class="bg-white shadow rounded overflow-hidden">
           <img src="" class="w-full h-48 object-cover">
           <div class="p-4">
           <h3 class="text-lg font-bold">'.$row["Name_Animals"].'</h3>
           <p>Food: Carnivore</p>
           <p>Habitat: Savannah</p>
           <div class="mt-4 flex gap-2">
            <button class="bg-yellow-400 text-white px-3 py-1 rounded">Edit</button>
            <button class="bg-red-500 text-white px-3 py-1 rounded">Delete</button>
          </div>
      </div>
        ';
      }
      ?>
    </div>

    <!-- Duplicate the above card for more animals dynamically with PHP -->
  </section>

  <!-- Statistics Graph Placeholder -->
  <section class="p-6">
    <h2 class="text-lg font-semibold mb-2">Animal Statistics</h2>
    <div class="bg-white shadow rounded p-4 h-64 flex items-center justify-center">
      <!-- You can integrate Chart.js here -->
      <span class="text-gray-400">Graph Placeholder</span>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-green-600 text-white p-4 text-center">
    &copy; 2025 Zoo Management System
  </footer>

</body>
</html>
