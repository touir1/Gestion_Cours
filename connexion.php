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
    <script type="application/javascript" src="js_connexion.js"></script>
    <title>Connexion</title>
</head>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Gestion des étudiants</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="index.php">Home</a></li>
            <li class="active"><a href="connexion.php">Connexion</a></li>
            <li><a href="connexion_professeur.php">Connexion Professeur</a></li>
        </ul>
    </div>
</nav>
<?php

include 'connexion_obj.php';
$c=new connexion();
$c->connect();
if (isset($_POST['user']) && isset($_POST['password'])) {
    if($c->verif_connect_etudiant($_POST['user'],$_POST['password'])){
        ?>
        <style>
            div.taille {
                width:500px;
                margin: auto;
            }
        </style>
        <div class="alert alert-success fade in taille">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Connection Réussite!</strong> Bienvenue <?php echo $_POST['user']." :)"?>.
        </div>
        <?php
        $_SESSION['user']=$_POST['user'];
        $_SESSION['connected']="1";
        ?>
        <meta http-equiv="refresh" content="2;url=home_etudiant.php">

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
if (isset($_POST['userinscri']) && isset($_POST['passwordinscri']) && isset($_POST['email']) && isset($_POST['confirm-password']) &&isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['cin'])) {
    if($_POST['userinscri']=="" || $_POST['passwordinscri']=="" || $_POST['email']=="" || $_POST['confirm-password']=="" || $_POST['nom']=="" || $_POST['prenom']=="" || $_POST['cin']==""){
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
    else if($c->verif_exist_etudiant($_POST['userinscri'])){
        ?>
        <style>
            div.taille {
                width:500px;
                margin: auto;
            }
        </style>
        <div class="alert alert-warning fade in taille">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Warning!</strong> Nom d'utilisateur déjà utilisé.
        </div>
        <?php
    }
    else if($c->search_etudiant_by_cin($_POST['cin'])){
        ?>
        <style>
            div.taille {
                width:500px;
                margin: auto;
            }
        </style>
        <div class="alert alert-warning fade in taille">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Warning!</strong> CIN déjà utilisé.
        </div>
        <?php
    }
    else if(!is_numeric($_POST['cin'])){
        ?>
        <style>
            div.taille {
                width:500px;
                margin: auto;
            }
        </style>
        <div class="alert alert-warning fade in taille">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Warning!</strong> CIN incorrect.
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
        $c->ajouter_etudiant($_POST['userinscri'],$_POST['passwordinscri'],$_POST['email'],$_POST['nom'],$_POST['prenom'],$_POST['cin'],$_POST['annee_etude'],$_POST['groupe']);
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
        $file = './img/default_user/etudiant_default';
        $newfile = './img/users/etudiant/'.$_POST['userinscri'];
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

                            <!--Connexion User-->
                            <div id="start">

                            </div>
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

                            <!--Inscription User-->

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
                                    <input type="text" name="nom" id="nom" tabindex="1" class="form-control" placeholder="Nom" value="">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="prenom" id="prenom" tabindex="2" class="form-control" placeholder="Prenom" value="">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="cin" id="cin" tabindex="3" class="form-control" placeholder="CIN" value="">
                                </div>
                                <div class="form-group">
                                    <label>Année d'étude: </label>
                                        <select class="form-control" name="annee_etude" id="annee_etude" tabindex="4">
                                            <option value="1">1ére année</option>
                                            <option value="2">2éme année</option>
                                            <option value="3">3éme année</option>
                                        </select>

                                </div>
                                <div class="form-group">
                                    <label>Groupe: </label>
                                    <select class="form-control" name="groupe" id="groupe" tabindex="5">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>


                                </div>
                                <div class="form-group">
                                    <input type="text" name="userinscri" id="userinscri" tabindex="6" class="form-control" placeholder="Username" value="">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" tabindex="7" class="form-control" placeholder="Email Address" value="">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="passwordinscri" id="passwordinscri" tabindex="8" class="form-control" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="confirm-password" id="confirm-password" tabindex="9" class="form-control" placeholder="Confirm Password">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="register-submit" id="register-submit" tabindex="10" class="form-control btn btn-register" value="S'inscrire">
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