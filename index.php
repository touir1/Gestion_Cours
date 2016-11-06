<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<?php
if(isset($_POST['connected_post'])) {
    $_SESSION['connected'] = $_POST['connected_post'];
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="css_connexion.css">
    <title>Home</title>
</head>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Gestion des étudiants</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="connexion.php">Connexion</a></li>
            <li><a href="connexion_professeur.php">Connexion Professeur</a></li>
        </ul>
    </div>
</nav>
</body>
</html>