<?php
    echo "wsh";
?>
<!DOCTYPE html>
<html>
    <header>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/client/css/lib/bootstrap.min.css" rel="stylesheet">
        <title>Informations</title>
    </header>
<body>
    <div class="container">
        <?php
            // Connexion à la base de données
            $host = "localhost";
            $username = "root";
            $password = "";
            $dbname = "climbingbdd";
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Nombre d'utilisateurs connectés
            $users = $pdo->query("SELECT COUNT(*) FROM user WHERE is_connecte = 1")->fetchColumn();

            // Nombre de connexions dans la journée
            $today = date("Y-m-d");
            $logins = $pdo->query("SELECT COUNT(*) FROM user WHERE derniere_connexion = '$today'")->fetchColumn();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        ?>
    <h1>Informations</h1>
    <div class="card">
        <h2 class="card-header">Ici, tu vas retrouver les statistiques sur les utilisateurs connectés : </h2>
        <div class="card-body">
          <ul class="list-group list-group-flush">
            <h5 class="list-group-item">
                <?php echo "Nombre d'utilisateurs connectés : $users";
                ?>
            </h5>
            <h5 class="list-group-item">
                <?php echo "Nombre de connexions dans la journée : $logins";
                ?>
            </h5>
          </ul>
        </div>
    </div>
    </div>
</body>
</html>