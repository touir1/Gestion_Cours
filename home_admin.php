<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
    <!DOCTYPE html>
    <html lang="fr" xmlns:trigger="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <script type="application/javascript" src="js_connexion.js"></script>
    <link rel="stylesheet" type="text/css" href="css_home.css">
    <script type="application/javascript" src="js_connexion.js"></script>
    <link rel="stylesheet" href="form-validation.css">
    <title>Etudiant</title>
</head>
<form id="post_connected" method="post" action="index.php">
    <input type="hidden" name="connected_post" value="0"/>
</form>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="home_admin.php">Gestion des &eacute;tudiants</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="#">Home</a></li>
            <li id="li_deconnect"><a id="bt_deconnexion" href="#" onclick="document.getElementById('post_connected').submit()")>D&eacute;connexion</a></li>
        </ul>
    </div>
</nav>
<?php
include 'connexion_obj.php';
$c=new connexion();
$c->connect();
$connected="no_username";
$info="";
if(isset($_SESSION['connected']) && $_SESSION['connected']=="1") {
    $info=$c->get_all_info_admin($_SESSION['user']);
    $connected = $_SESSION['user'];
    $_SESSION['image_path']="./img/users/admin/".$connected."/";
    if(isset($_POST['titreart']) && isset($_POST['article'])){
        if($_POST['titreart']!="" && $_POST['article']!=""){
            $c->ajouter_article($connected,$_POST['titreart'],$_POST['article']);
            ?>
            <style>
                div.taille {
                    width:500px;
                    margin: auto;
                }
            </style>
            <div class="alert alert-success fade in taille">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>L'article a bien &eacute;t&eacute; ajout&eacute;!</strong>.
            </div>
            <meta http-equiv="refresh" content="2;url=home_admin.php">
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
                <strong>Warning!</strong> champs non complet.
            </div>
            <?php
        }
    }
    if (isset($_POST['confirm-password']) && isset($_POST['passwordinscri'])) {
        if($c->verif_connect_admin($connected,$_POST['old-password'])){
            if($_POST['confirm-password']!="" && $_POST['passwordinscri']!=""){
                if($_POST['passwordinscri']==$_POST['confirm-password'] ){
                    $c->modifier_auth_admin($connected,$_POST['passwordinscri']);
                    ?>
                    <style>
                        div.taille {
                            width:500px;
                            margin: auto;
                        }
                    </style>
                    <div class="alert alert-success fade in fade out taille">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>La modification a bien &eacute;t&eacute; r&eacute;alis&eacute;!</strong>.
                    </div>
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
                        <strong>Warning!</strong> mot de passe ne sont pas identiques.
                    </div>
                    <?php
                }
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
                    <strong>Warning!</strong> mot de passe ne sont pas identiques.
                </div>
                <?php
            }
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
                <strong>Warning!</strong> mot de passe incorrect.
            </div>
            <?php
        }
    }

    if(isset($_POST['supprimer'])){
        $c->delete_article($_POST['supprimer']);
        ?>
        <style>
            div.taille {
                width:500px;
                margin: auto;
            }
        </style>
        <div class="alert alert-success fade in fade out taille">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>La suppression a bien &eacute;t&eacute; r&eacute;alis&eacute;!</strong>.
        </div>

        <?php
    }

    if(isset($_POST['supprimerEtudiant'])){
        $c->delete_etudiant($_POST['supprimerEtudiant']);
        ?>
        <style>
            div.taille {
                width:500px;
                margin: auto;
            }
        </style>
        <div class="alert alert-success fade in fade out taille">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>La suppression a bien &eacute;t&eacute; r&eacute;alis&eacute;!</strong>.
        </div>

        <?php
    }

    if(isset($_POST['supprimerProfesseur'])){
        $c->delete_professeur($_POST['supprimerProfesseur']);
        ?>
        <style>
            div.taille {
                width:500px;
                margin: auto;
            }
        </style>
        <div class="alert alert-success fade in fade out taille">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>La suppression a bien &eacute;t&eacute; r&eacute;alis&eacute;!</strong>.
        </div>

        <?php
    }
}
else{
    ?>
    <style>
        body { background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAALEgAACxIB0t1+/AAAABZ0RVh0Q3JlYXRpb24gVGltZQAxMC8yOS8xMiKqq3kAAAAcdEVYdFNvZnR3YXJlAEFkb2JlIEZpcmV3b3JrcyBDUzVxteM2AAABHklEQVRIib2Vyw6EIAxFW5idr///Qx9sfG3pLEyJ3tAwi5EmBqRo7vHawiEEERHS6x7MTMxMVv6+z3tPMUYSkfTM/R0fEaG2bbMv+Gc4nZzn+dN4HAcREa3r+hi3bcuu68jLskhVIlW073tWaYlQ9+F9IpqmSfq+fwskhdO/AwmUTJXrOuaRQNeRkOd5lq7rXmS5InmERKoER/QMvUAPlZDHcZRhGN4CSeGY+aHMqgcks5RrHv/eeh455x5KrMq2yHQdibDO6ncG/KZWL7M8xDyS1/MIO0NJqdULLS81X6/X6aR0nqBSJcPeZnlZrzN477NKURn2Nus8sjzmEII0TfMiyxUuxphVWjpJkbx0btUnshRihVv70Bv8ItXq6Asoi/ZiCbU6YgAAAABJRU5ErkJggg==);}
        .error-template {padding: 40px 15px;text-align: center;}
        .error-actions {margin-top:15px;margin-bottom:15px;}
        .error-actions .btn { margin-right:10px; }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="error-template">
                    <h1>Oops!</h1>
                    <h2>You are not connected</h2>
                    <div class="error-details">
                        You need to be connected to access this page.Redirecting you now.
                    </div>
                    <meta http-equiv="refresh" content="2;url=connexion_admin.php">
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
<div class="container" style="display: <?php if(isset($_SESSION['connected']) && $_SESSION['connected']=="1")echo 'block'; else echo 'none';?>" id="page_principal">
    <div class="row profile">
        <div class="col-md-3">
            <div class="profile-sidebar">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="<?php
                    if(file_exists("./img/users/admin/".$connected."/pic.png")) {

                        $c->convert_image("./img/users/admin/".$connected."/pic.png",500,500);
                        echo "./img/users/admin/" . $connected . "/pic.png";
                    }
                    else{
                        echo "./img/users/admin/" . $connected . "/default.png";
                    }
                    ?>"  class="img-responsive" alt="" rel="popover"
                         data-toggle="popover" tabindex="50" data-content='
                         <form action="upload_image.php" method="post" enctype="multipart/form-data">
                         <input type="file" name="avatar" onchange="this.form.submit()"/>
                        </form>
                    'data-placement="right"
                        >
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        <?php echo $connected ?>
                    </div>
                    <div class="profile-usertitle-job">
                        Administrateur Institut Sup&eacute;rieur de Gestion de Tunis
                    </div>
                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li class="active" id="li_overview">
                            <a href="" id="bt_overview">
                                <i class="glyphicon glyphicon-home"></i>
                                Overview </a>
                        </li>
                        <li id="li_parametre">
                            <a href="" id="bt_parametre">
                                <i class="glyphicon glyphicon-cog"></i>
                                Param&egrave;tres du compte </a>
                        </li>
                        <li id="li_article">
                            <a href="" id="bt_article">
                                <i class="glyphicon glyphicon-list"></i>
                                Article </a>
                        </li>
                        <li id="li_gestioncompte">
                            <a href="" id="bt_gestioncompte">
                                <i class="glyphicon glyphicon-wrench"></i>
                                Gestion Comptes </a>
                        </li>
                    </ul>
                </div>
                <!-- END MENU -->
            </div>
        </div>
        <div class="col-md-9" id="main2">
            <div class="profile-content" id="main_content_div" >

                <div class="main-content4" id="main-content4" style="display: none">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Etudiants<hr></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        for($i=0;$i<$c->get_number_etudiant();$i++){
                            $res=$c->get_compte_etudiant($i);
                            ?>
                            <tr>
                                <td>
                                    <blockquote>

                                        <strong><?php echo $res['user'] ?></strong><br>
                                        <?php echo "nom et prenom: ".$res['nom']." ".$res['prenom'] ?><br>
                                        <?php echo "cin: ".$res['cin'] ?><br>
                                        <?php echo "groupe: ".$res['groupe'] ?><br>
                                        <footer>email: <mark><i><?php echo $res['email']?></i></mark></footer>
                                        <form action="home_admin.php" method="post">
                                            <input type="hidden" name="supprimerEtudiant" value="<?php echo $res['id_etudiant'] ?>">
                                            <input type="submit" value="Supprimer" class="btn btn-primary" style="float: right;">
                                        </form>
                                    </blockquote>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Professeur<hr></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        for($i=0;$i<$c->get_number_professeur();$i++){
                            $res=$c->get_compte_prof($i);
                            ?>
                            <tr>
                                <td>
                                    <blockquote>

                                        <strong><?php echo $res['user'] ?></strong><br><Br>
                                        <form action="home_admin.php" method="post">
                                            <input type="hidden" name="supprimerProfesseur" value="<?php echo $res['id'] ?>">
                                            <input type="submit" value="Supprimer" class="btn btn-primary" style="float: right;">
                                        </form>
                                    </blockquote>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

                <div class="main-content3" id="main-content3" style="display: block">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Articles<hr></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        for($i=0;$i<$c->get_number_article();$i++){
                            $res=$c->get_article($i);
                            ?>
                            <tr>
                                <td>
                                    <blockquote>
                                        <strong><?php echo $res['titre'] ?></strong><br>
                                        <?php echo $res['texte'] ?><br><br>
                                        <footer>&eacute;dit&eacute; par: <mark><i><?php echo $res['user']?></i></mark></footer>
                                        <form action="home_admin.php" method="post">
                                            <input type="hidden" name="supprimer" value="<?php echo $res['id'] ?>">
                                            <input type="submit" value="Supprimer" class="btn btn-primary" style="float: right;">
                                        </form>
                                    </blockquote>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

                <div class="main-content2" id="main-content2" style="display: none">

                    <form class="form-validation" method="post" action="home_professeur.php" style="display:block">

                        <div class="form-title-row">
                            <h1>Ajouter Article</h1>
                        </div>

                        <div class="form-row">
                            <label>
                                <span>Titre article</span>
                                <input type="text" name="titreart" id="titreart" placeholder="Titre Article" required>
                            </label>
                        </div>
                        <div class="form-row">
                            <label>
                                <span>Article</span>
                                <textarea class="form-control" rows="5" cols="50" id="article" name="article" required></textarea>
                            </label>
                        </div>

                        <div class="form-row">
                            <label>
                                <button type="submit" class="btn" name="bt_valider">Valider Article</button>
                            </label>
                        </div>



                    </form>

                </div>


                <div class="main-content" id="main-content" style="display: none">

                    <form class="form-validation" method="post" action="home_professeur.php" style="display:block">

                        <div class="form-title-row">
                            <h1>Changer Informations</h1>
                        </div>

                        <div class="form-row">
                            <label>
                                <span>Password</span>
                                <input type="password" name="passwordinscri" id="passwordinscri" placeholder="Password" >
                            </label>
                        </div>
                        <div class="form-row">
                            <label>
                                <span>Confirm Password</span>
                                <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm Password">
                            </label>
                        </div>

                        <div class="form-row">
                            <label>
                                <span>Old Password*</span>
                                <input type="password" name="old-password" id="old-password" placeholder="Old Password" required>
                            </label>
                        </div>

                        <div class="form-row">
                            <label>
                                <button type="submit" class="btn" name="bt_valider">Valider Changement</button>
                            </label>
                        </div>



                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php
$c->disconnect();
?>