<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<?php
/**
 * Created by PhpStorm.
 * User: MohamedAli
 * Date: 16/03/2016
 * Time: 12:51
 */

//$_FILES['avatar']['name'];
$path_image=$_SESSION['image_path'];
$name_image="pic.png";

$dossier = $path_image;
$fichier = basename($name_image);
$taille_maxi = 10000000;
$taille = filesize($_FILES['avatar']['tmp_name']);
$extensions = array('.png', '.gif', '.jpg', '.jpeg','.PNG', '.GIF', '.JPG', '.JPEG');
$extension = strrchr($_FILES['avatar']['name'], '.');
//Début des vérifications de sécurité...
if (!in_array($extension, $extensions)){ //Si l'extension n'est pas dans le tableau
    $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg...';
}
if ($taille > $taille_maxi) {
    $erreur = 'Le fichier est trop gros...';
}
if (!isset($erreur)){ //S'il n'y a pas d'erreur, on upload
    //On formate le nom du fichier ici...
    $fichier = strtr($fichier,
        'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
        'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
    $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier . $fichier)){ //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
        echo 'Upload effectué avec succès !';
        ?><meta http-equiv="refresh" content="1;url=home_etudiant.php"><?php
    } else{ //Sinon (la fonction renvoie FALSE).
        echo 'Echec de l\'upload !';
        ?><meta http-equiv="refresh" content="1;url=home_etudiant.php"><?php
    }
} else {
    echo $erreur;
    ?><meta http-equiv="refresh" content="1;url=home_etudiant.php"><?php
}



?>