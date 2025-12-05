<?php
include "../Pages/sql_connect.php";

$sendtosql = "SELECT * FROM habitat;";
$result = $connection->query($sendtosql);

if(isset($_POST["subhabi"])){
    $newhabname = $_POST["habi"];
    $newhabDescri = $_POST["descri"];
    
    $newhabi = "INSERT INTO habitat(Description_habi, NomHab)
                VALUE('$newhabDescri', '$newhabname');";
    $connection->query($newhabi);
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
        <main class="w-full ">
            <header class="mb-6">
                <h1 class="text-center mt-5 text-2xl font-semibold text-gray-800">Add Habitat & Show Existing Habitats</h1>
            </header>
            <section class="grid lg:w-[90%] lg:m-5 grid-cols-1 md:grid-cols-2 gap-6">
                <form method="POST" class="bg-white p-5 rounded-2xl shadow-sm">
                    <h2 class="text-lg font-medium mb-3">Add a new habitat</h2>

                    <label class="block mb-2 text-sm text-gray-600">Habitat name</label>
                    <input name="habi" required type="text" placeholder="e.g. Savannah" class="w-full mb-4 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300" />

                    <label class="block mb-2 text-sm text-gray-600">Short description (optional)</label>
                    <input name="descri" type="text" placeholder="e.g. Hot grassland area" class="w-full mb-4 p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300" />

                    <div class="flex items-center gap-3">
                        <button type="submit" name="subhabi" class="px-4 py-2 bg-green-600 text-white rounded-lg shadow-sm hover:bg-green-700">Add Habitat</button>
                        <button class="px-3 py-2 bg-red-50 text-red-600 rounded-lg border border-red-100">
                            <a href="../index.php">Cancel</a>
                        </button>
                    </div>
                    <p id="formMsg" class="mt-3 text-sm text-gray-500"></p>
                </form>
                <div class="bg-white p-5 rounded-2xl shadow-sm">
                    <div class="overflow-x-auto lg:w-full">
                    <table class="min-w-full border border-gray-200 rounded-xl ">
                        <thead class="bg-green-600 text-white">
                        <tr>
                            <th class="px-4 py-2 text-left">ID</th>
                            <th class="px-4 py-2 text-left">Habitat Name</th>
                            <th class="px-4 py-2 text-left">Description</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white">
                            <?php
                             foreach ($result as $resul){
                                    echo "
                                    <tr class='border-b'>
                                        <td class='px-4 py-2'>".$resul['IdHabitat']."</td>
                                        <td class='px-4 py-2'>".$resul['NomHab']."</td>
                                        <td class='px-4 py-2'>".$resul['Description_habi']."</td>
                                        <td class='px-4 py-2 flex gap-2'>
                                        <button class='px-3 py-1 bg-red-600 text-white rounded'>
                                        <a href='./delete_habitat.php?id=".$resul['IdHabitat']."'>Delete</a>
                                        </button>
                                        </td>
                                    </tr>
                                    " ;
                                }
                             ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </section>
        </main>
        <section>
            <div id="deletePopup" class="hidden fixed inset-0 bg-black bg-opacity-50 justify-center items-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-80">
                <h2 class="text-xl font-semibold mb-4">Confirm Delete</h2>
                <p class="mb-6 text-gray-700">Are you sure you want to delete this item?</p>

                <div class="flex justify-end gap-3">
                    <button onclick="closeDeletePopup()" 
                            class="px-4 py-2 bg-gray-300 text-gray-800 rounded">
                        Cancel
                    </button>
                    <form action="delete.php" method="POST">
                        <input type="hidden" name="id" value="<!-- put ID here -->">
                        <button type="submit" 
                                class="px-4 py-2 bg-red-500 text-white rounded">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
        </section>
        <footer class="bg-green-600 text-white p-4 text-center">
            2025 Zoo Management System
        </footer>
    </body>

    </html>