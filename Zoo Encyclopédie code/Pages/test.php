<?php

include './sql_connect.php';

if(isset($_GET['action'])){
    $action = $_GET['action'];
    header('Content-Type: application/json');

    if($action === 'habitat_counts'){
        $sql = "SELECT h.IdHabitat AS id, h.NomHab AS name, COUNT(a.ID_Animals) AS cnt
                FROM habitat h
                LEFT JOIN animals a ON a.HabitatID = h.IdHabitat
                GROUP BY h.IdHabitat, h.NomHab
                ORDER BY cnt DESC";
        $res = $connection->query($sql);
        $out = [];

        foreach($res as $row){
            $out[] = $row;
        }

        echo json_encode($out);
        exit;
    }

    if($action === 'food_counts'){
        $sql = "SELECT Alimentaire_type AS type, COUNT(*) AS cnt FROM animals GROUP BY Alimentaire_type";
        $res = $connection->query($sql);
        $out = [];

        foreach($res as $row){
            $out[] = $row;
        }

        echo json_encode($out);
        exit;
    }

    if($action === 'recent_animals'){
        $sql = "SELECT a.ID_Animals AS id, a.Name_Animals AS name, a.Image_Animals AS img, h.NomHab AS habitat
                FROM animals a
                LEFT JOIN habitat h ON a.HabitatID = h.IdHabitat
                ORDER BY a.ID_Animals DESC LIMIT 10";
        $res = $connection->query($sql);
        $out = [];

        foreach($res as $row){
            $out[] = $row;
        }

        echo json_encode($out);
        exit;
    }

    echo json_encode(['error' => 'unknown action']);
    exit;
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

<body class="bg-slate-100 text-slate-800">
  <div class="max-w-6xl mx-auto p-6">
    <header class="flex items-center justify-between mb-6">
      <h1 class="text-2xl font-bold">Stupid Animal Stats (no functions)</h1>
      <div class="text-sm text-slate-600">Direct, dumb, and working.</div>
    </header>
    <section class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div class="bg-white p-4 rounded-2xl shadow">
        <h2 class="font-medium mb-2">Animals per habitat (bar)</h2>
        <div class="relative h-[380px]">
            <canvas id="habitatBar"></canvas>
        </div>
      </div>
      <div class="bg-white p-4 rounded-2xl shadow">
        <h2 class="font-medium mb-2">Food type distribution (pie)</h2>
        <div class="relative h-[380px]">
            <canvas id="foodPie"></canvas>
        </div>
      </div>
      <div class="bg-white p-4 rounded-2xl shadow md:col-span-2">
        <div class="flex items-center justify-between mb-3">
          <h2 class="font-medium">Recent animals</h2>
          <button id="refreshList" class="px-3 py-1 text-sm rounded bg-slate-200">Refresh</button>
        </div>
        <div id="recentList" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3"></div>
      </div>
    </section>
    <footer class="mt-6 text-xs text-slate-500">Change the include path if needed.</footer>
  </div>
<script>
fetch('?action=habitat_counts')
.then(r => r.json())
.then(data => {
  var labels = data.map(x => x.name);
  var counts = data.map(x => Number(x.cnt));

  new Chart(document.getElementById('habitatBar').getContext('2d'), {
    type: 'bar',
    data: { labels: labels, datasets: [{ label: 'Animals', data: counts }] },
    options: { 
        responsive:true, 
        maintainAspectRatio:false,
        plugins:{ legend:{ display:false } }
    }
  });
});

fetch('?action=food_counts')
.then(r => r.json())
.then(data => {
  var labels = data.map(x => x.type);
  var counts = data.map(x => Number(x.cnt));

  new Chart(document.getElementById('foodPie').getContext('2d'), {
    type: 'pie',
    data:{ labels:labels, datasets:[{ data:counts }] },
    options:{ responsive:true, maintainAspectRatio:false }
  });
});

function loadRecent(){
  fetch('?action=recent_animals')
  .then(r => r.json())
  .then(list => {
    var box = document.getElementById('recentList');
    box.innerHTML = '';

    list.forEach(a => {
      let card = document.createElement('div');
      card.className = 'bg-slate-50 p-3 rounded-lg flex flex-col gap-2 items-center text-center';

      let img = document.createElement('img');
      img.className = 'w-24 h-24 object-cover rounded-full border';
      img.src = a.img && a.img.trim() !== '' ? a.img : 'https://placehold.co/200';

      let name = document.createElement('div');
      name.className = 'font-medium';
      name.textContent = a.name;

      let hab = document.createElement('div');
      hab.className = 'text-xs text-slate-500';
      hab.textContent = a.habitat;

      card.appendChild(img);
      card.appendChild(name);
      card.appendChild(hab);

      box.appendChild(card);
    });
  });
}

loadRecent();
document.getElementById('refreshList').onclick = loadRecent;
</script>

</body>
</html>
