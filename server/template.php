<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?= $titre ?></title>
</head>
<body>
    <div id="global">
        <header id="header">
            <a href=""><h1 id="titreBlog">Accueil</h1></a>
            <a href=""><h1 id="titreBlog">Salles</h1></a>
            <a href=""><h1 id="titreBlog">Mon Profil</h1></a>
            <a href=""><h1 id="titreBlog">Se déconnecter</h1></a>
            <h1>Bienvenue sur climbing !</h1>
        </header>
        <div id="contenu">
            <?= $contenu ?>
        </div>
        <footer id="footer">
            <i> Site réalisé avec par Clément, Wassim, Audric, Nils et Timothé avec HTML CSS et PHP.</i>
        </footer>
    </div>
</body>
</html>