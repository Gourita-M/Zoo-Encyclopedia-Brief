<?php
include "./sql_connect.php";

// 1. Total animals
$total_sql = "SELECT COUNT(*) AS total_animals FROM animals";
$total_result = $connection->query($total_sql);
$total = $total_result->fetch_assoc()['total_animals'];

// 2. Animals by habitat
$habitat_sql = "
    SELECT Habitat.NomHab, COUNT(Animals.ID_Animals) AS count_animals
    FROM animals
    JOIN habitat ON animals.HabitatID = habitat.IdHabitat
    GROUP BY Habitat.NomHab
";
$habitat_result = $connection->query($habitat_sql);

// 3. Animals by food type
$type_sql = "
    SELECT Alimentaire_type, COUNT(*) AS count_type
    FROM animals
    GROUP BY Alimentaire_type
";
$type_result = $connection->query($type_sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Statistics</title>
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
<main class="bg-gray-100 p-6">

<h1 class="text-3xl font-bold mb-6">Zoo Statistics</h1>

<!-- Total animals -->
<div class="bg-white shadow rounded p-6 mb-6">
  <h2 class="text-xl font-semibold mb-2">Total Animals</h2>
  <p class="text-4xl font-bold text-blue-600"><?php echo $total; ?></p>
</div>

<!-- Animals per habitat -->
<div class="bg-white shadow rounded p-6 mb-6">
  <h2 class="text-xl font-semibold mb-4">Animals by Habitat</h2>
  <table class="w-full border">
    <tr class="bg-gray-200">
      <th class="border px-4 py-2">Habitat</th>
      <th class="border px-4 py-2">Count</th>
    </tr>

    <?php while ($row = $habitat_result->fetch_assoc()) { ?>
      <tr>
        <td class="border px-4 py-2"><?php echo $row['NomHab']; ?></td>
        <td class="border px-4 py-2"><?php echo $row['count_animals']; ?></td>
      </tr>
    <?php } ?>

  </table>
</div>

<!-- Animals by food type -->
<div class="bg-white shadow rounded p-6">
  <h2 class="text-xl font-semibold mb-4">Animals by Food Type</h2>
  <table class="w-full border">
    <tr class="bg-gray-200">
      <th class="border px-4 py-2">Food Type</th>
      <th class="border px-4 py-2">Count</th>
    </tr>

    <?php while ($row = $type_result->fetch_assoc()) { ?>
      <tr>
        <td class="border px-4 py-2"><?php echo $row['Alimentaire_type']; ?></td>
        <td class="border px-4 py-2"><?php echo $row['count_type']; ?></td>
      </tr>
    <?php } ?>

  </table>
</div>

</main>
<footer class="bg-green-600 text-white p-4 text-center">
    2025 Zoo Management System
</footer>
</body>
</html>
