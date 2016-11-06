<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
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
    <script type="application/javascript" src="js_connexion.js"></script>
    <link rel="stylesheet" type="text/css" href="css_connexion.css">

    <title>Connexion Professeur</title>
</head>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Gestion des &eacute;tudiants</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php">Home</a></li>
            <li><a href="connexion.php">Connexion</a></li>
            <li class="active"><a href="connexion_professeur.php">Connexion Professeur</a></li>
        </ul>
    </div>
</nav>
<?php
include 'connexion_obj.php';
$c=new connexion();
$c->connect();
if (isset($_POST['user']) && isset($_POST['password'])) {
    if($c->verif_connect_professeur($_POST['user'],$_POST['password'])){
        ?>
        <style>
            div.taille {
                width:500px;
                margin: auto;
            }
        </style>
        <div class="alert alert-success fade in taille">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Connection R&eacute;ussite!</strong> Bienvenue <?php echo $_POST['user']." :)"?>.
        </div>
        <?php
            $_SESSION['user']=$_POST['user'];
            $_SESSION['connected']="1";
        ?>
        <meta http-equiv="refresh" content="2;url=home_professeur.php">
        <?php
    }
    else{
        ?>
        <style>
            div.taille {
                width:500px;
                margin: auto;
            }
        </style>
        <div class="alert alert-warning fade in taille">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Warning!</strong> Nom d'utilisateur ou mot de passe incorrect.
        </div>
        <?php
    }
}
if (isset($_POST['userinscri']) && isset($_POST['passwordinscri'])&& isset($_POST['confirm-password'])) {
    if($_POST['userinscri']=="" || $_POST['passwordinscri']=="" || $_POST['confirm-password']==""){
        ?>
        <style>
            div.taille {
                width:500px;
                margin: auto;
            }
        </style>
        <div class="alert alert-warning fade in taille">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Warning!</strong> Veuillez remplir tout les champs.
        </div>
        <?php
    }
    else if($c->verif_exist_professeur($_POST['userinscri'])){
        ?>
        <style>
            div.taille {
                width:500px;
                margin: auto;
            }
        </style>
        <div class="alert alert-warning fade in taille">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Warning!</strong> Nom d'utilisateur d&eacute;j&agrave; utilis&eacute;.
        </div>
        <?php
    }
    else if($_POST['passwordinscri']!=$_POST['confirm-password']){
        ?>
        <style>
            div.taille {
                width:500px;
                margin: auto;
            }
        </style>
        <div class="alert alert-warning fade in taille">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Warning!</strong> les mots de passes saisie ne sont pas identique.
        </div>
        <?php
    }
    else{
        $c->ajouter_professeur($_POST['userinscri'],$_POST['passwordinscri']);
        ?>
        <style>
            div.taille {
                width:500px;
                margin: auto;
            }
        </style>
        <div class="alert alert-success fade in taille">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> Compte cr&eacute;e.
        </div>
        <?php
        $file = './img/default_user/professeur_default';
        $newfile = './img/users/professeur/'.$_POST['userinscri'];
        mkdir("$newfile", 0700,true);
        copy($file.'/default.png', $newfile.'/default.png');
    }
}
$c->disconnect();
?>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="#"
                                <?php
                                if(isset($_POST['user']) || !isset($_POST['userinscri'] )){
                                    ?>
                                    class="active"
                                    <?php
                                }
                                ?>
                               id="login-form-link">Connexion</a>
                        </div>
                        <div class="col-xs-6">
                            <a href="#"
                                <?php
                                if(isset($_POST['userinscri'])){
                                    ?>
                                    class="active"
                                    <?php
                                }
                                ?>
                               id="register-form-link">Inscription</a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="login-form" action="#" method="post" role="form" style="display:
                            <?php
                            if(isset($_POST['user']) || !isset($_POST['userinscri'] )){
                                ?>
                                block
                                <?php
                            }
                            else{
                                ?>
                                none
                                <?php
                            }
                            ?>
                                ;">
                                <div class="form-group">
                                    <input type="text" name="user" id="user" tabindex="1" class="form-control" placeholder="Username" value="">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Se Connecter">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form id="register-form" action="#" method="post" role="form" style="display:
                            <?php
                            if(isset($_POST['userinscri'])){
                                ?>
                                block
                                <?php
                            }
                            else{
                                ?>
                                none
                                <?php
                            }
                            ?>
                                ;">
                                <div class="form-group">
                                    <input type="text" name="userinscri" id="userinscri" tabindex="1" class="form-control" placeholder="Username" value="">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="passwordinscri" id="passwordinscri" tabindex="2" class="form-control" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="S'inscrire">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>