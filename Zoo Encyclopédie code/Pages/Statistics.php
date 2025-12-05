<?php

include './sql_connect.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    header('Content-Type: application/json');

    if ($action === 'habitat_counts') {
        $sql = "SELECT Habitat.IdHabitat AS id, Habitat.NomHab AS name, COUNT(Animals.ID_Animals) AS cnt
                FROM Habitat
                JOIN Animals ON Animals.HabitatID = Habitat.IdHabitat
                GROUP BY Habitat.IdHabitat, Habitat.NomHab ";
        $res = $connection->query($sql);
        $out = [];

        foreach ($res as $row) {
            $out[] = $row;
        }

        echo json_encode($out);
        exit;
    }

    if ($action === 'food_counts') {
        $sql = "SELECT Alimentaire_type AS type, COUNT(*) AS cnt 
                FROM Animals 
                GROUP BY Alimentaire_type";
        $res = $connection->query($sql);
        $out = [];

        foreach ($res as $row) {
            $out[] = $row;
        }

        echo json_encode($out);
        exit;
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Statistics</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
    <main class="bg-slate-100 text-slate-800">
        <div class="max-w-6xl mx-auto p-6">
            <section class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold">Statistics</h1>
            </section>
            <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-4 rounded-2xl shadow">
                    <h2 class="font-medium mb-2">Animals per habitat (bar)</h2>
                    <div class="relative h-[445px]">
                        <canvas id="habitatBar"></canvas>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-2xl shadow">
                    <h2 class="font-medium mb-2">Alimentaire Type</h2>
                    <div class="relative h-[445px]">
                        <canvas id="foodPie"></canvas>
                    </div>
                </div>
            </section>
        </div>
    </main>
    <footer class="bg-green-600 text-white p-4 text-center">
        2025 Zoo Management System
    </footer>
    <script>
        fetch('?action=habitat_counts')
            .then(r => r.json())
            .then(data => {
                let labels = data.map(x => x.name);
                let counts = data.map(x => x.cnt);

                new Chart(document.getElementById('habitatBar').getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Animals',
                            data: counts
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            });

        fetch('?action=food_counts')
            .then(r => r.json())
            .then(data => {
                let labels = data.map(x => x.type);
                let counts = data.map(x => x.cnt);

                new Chart(document.getElementById('foodPie').getContext('2d'), {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: counts
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            });
    </script>

</body>

</html>