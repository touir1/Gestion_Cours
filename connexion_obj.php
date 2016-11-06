
<?php

/**
 * Created by PhpStorm.
 * User: MohamedAli
 * Date: 05/03/2016
 * Time: 17:46
 * @property  connected
 */

class connexion
{
    private $servername="";
    private $dbname="";
    private $username="";
    private $password="";
    private $connected;

    function __construct() {
        $this->servername = "localhost";
        $this->dbname = "gestion_etudiant";
        $this->username = "root";
        $this->password = "";

    }

    function connect(){

        try {
            $this->connected = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            // set the PDO error mode to exception
            $this->connected->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function  disconnect(){
        $this->connected=null;
    }

    function verif_connect_etudiant($user,$password){
        $id=-1;
        if($id=$this->verif_exist_etudiant($user)>0){
            $sql="SELECT id, user, password FROM auth";
            foreach($this->connected->query($sql) as $row) {
                if ($row['password'] == $password && $row['user']==$user) {
                    return true;
                }
            }
            return false;
        }
    }

    function verif_exist_etudiant($user)
    {
        $sql="SELECT id, user FROM auth";
        foreach($this->connected->query($sql) as $row) {
            if($row['user']==$user) {
                return $row['id'];
            }
        }
        return 0;
    }

    function get_all_info_professeur($user){
        $sql="SELECT id, user, password FROM professeur";
        //$info['user']=$user;
        $id="0";
        foreach($this->connected->query($sql) as $row) {
            if($row['user']==$user) {
                $id=$row['id'];
                $info=$id;
            }
        }

        return $info;
    }

    function get_all_info_admin($user){
        $sql="SELECT id, user, password FROM admin";
        //$info['user']=$user;
        $id="0";
        foreach($this->connected->query($sql) as $row) {
            if($row['user']==$user) {
                $id=$row['id'];
                $info=$id;
            }
        }

        return $info;
    }

    function get_all_info_etudiant($user){
        $sql="SELECT id_etudiant, user, password FROM auth";
        $info['user']=$user;
        $id="0";
        foreach($this->connected->query($sql) as $row) {
            if($row['user']==$user) {
                $id=$row['id_etudiant'];
                $info['password']=$row['password'];
            }
        }
        $sql="SELECT id, nom, prenom, cin, groupe, annee_actuelle, email FROM liste_etudiant";
        foreach($this->connected->query($sql) as $row) {
            if($row['id']==$id) {
                $info['id']=$id;
                $info['nom']=$row['nom'];
                $info['prenom']=$row['prenom'];
                $info['cin']=$row['cin'];
                $info['groupe']=$row['groupe'];
                $info['annee_actuelle']=$row['annee_actuelle'];
                $info['email']=$row['email'];
            }
        }
        return $info;
    }



    function verif_connect_admin($user,$password){
        if($id=$this->verif_exist_admin($user)>0){
            $sql="SELECT id, user, password FROM admin";
            foreach($this->connected->query($sql) as $row) {
                if ($row['password'] == $password && $row['user']==$user) {
                    return true;
                }
            }
            return false;
        }
    }

    function verif_exist_admin($user)
    {
        $sql="SELECT id, user FROM admin";
        foreach($this->connected->query($sql) as $row) {
            if($row['user']==$user)
                return $row['id'];
        }
        return 0;
    }

    function getNom_etudiant($user){
        $sql="SELECT id_etudiant,user FROM auth";
        foreach($this->connected->query($sql) as $row) {
            if($row['user']==$user) {
                //echo $row['id_etudiant'];
                $sql = "SELECT id,nom,prenom FROM liste_etudiant";
                foreach ($this->connected->query($sql) as $row1) {
                    //echo $row1['nom'] . ' ' . $row1['prenom'];
                    if($row1['id']==$row['id_etudiant'])
                        return $row1['nom'] . ' ' . $row1['prenom'];
                }
            }
        }
        return "";

    }

    function get_number_article(){
        $sql="SELECT count(*) as cc FROM article";
        $res=0;
        foreach($this->connected->query($sql) as $row){
            $res=$row['cc'];
        }
        return intval($res);
    }


    function get_article($numero){
        $sql="SELECT id_article,titre,texte,user FROM article";
        $res['id']="";
        $res['titre']="";
        $res['texte']="";
        $res['user']="";
        $id="";
        $count=0;
        foreach($this->connected->query($sql) as $row){
            if($count==$numero){
                $res['id']=$row['id_article'];
                $res['titre']=$row['titre'];
                $res['texte']=$row['texte'];
                $res['user']=$row['user'];
                return $res;
            }
            else
                $count = $count+1;
        }
    }

    function get_number_professeur(){
        $sql="SELECT count(*) as cc FROM professeur";
        $res=0;
        foreach($this->connected->query($sql) as $row){
            $res=$row['cc'];
        }
        return intval($res);
    }

    function get_compte_prof($numero){
        $sql="SELECT id, user FROM professeur";
        $res['id']="";
        $res['user']="";
        $id="";
        $count=0;
        foreach($this->connected->query($sql) as $row){
            if($count==$numero){
                $res['id']=$row['id'];
                $res['user']=$row['user'];
                return $res;
            }
            else
                $count = $count+1;
        }
    }

    function get_number_etudiant(){
        $sql="SELECT count(*) as cc FROM liste_etudiant";
        $res=0;
        foreach($this->connected->query($sql) as $row){
            $res=$row['cc'];
        }
        return intval($res);
    }

    function get_compte_etudiant($numero){
        $sql="SELECT id, user, id_etudiant FROM auth";
        $res['id']="";
        $res['user']="";
        $res['id_etudiant']="";
        $res['nom']="";
        $res['prenom']="";
        $res['cin']="";
        $res['groupe']="";
        $res['email']="";
        $id="";
        $count=0;
        foreach($this->connected->query($sql) as $row){
            if($count==$numero){
                $res['id']=$row['id'];
                $res['user']=$row['user'];
                $res['id_etudiant']=$row['id_etudiant'];
                $sql="SELECT nom, prenom, cin, groupe, email FROM liste_etudiant WHERE id = ".$res['id_etudiant'];
                foreach($this->connected->query($sql) as $row2){
                    $res['nom']=$row2['nom'];
                    $res['prenom']=$row2['prenom'];
                    $res['cin']=$row2['cin'];
                    $res['groupe']=$row2['groupe'];
                    $res['email']=$row2['email'];
                }
                return $res;
            }
            else
                $count = $count+1;
        }
    }

    function convert_image($path,$new_width,$new_height){
        list($width, $height) = getimagesize($path);
        if($width>$new_width || $height>$new_height) {
            $t=imagecreate($new_width,$new_height);
            switch(exif_imagetype($path)) {
                case 1:
                    $t = imagecreatefromgif($path);
                    break;
                case 2:
                    $t = imagecreatefromjpeg($path);
                    break;
                case 3:
                    $t = imagecreatefrompng($path);
                    break;
                case 15:
                    $t = imagecreatefromwbmp($path);
                    break;
                default: break;
            }
                $x = imagesx($t);
                $y = imagesy($t);

                $s = imagecreatetruecolor($new_width, $new_height);

                imagecopyresampled($s, $t, 0, 0, 0, 0, $new_width, $new_height,
                $x, $y);

                imagepng($s, $path);
        }
    }

    function getClasse_etudiant($user){
        $sql="SELECT id_etudiant,user FROM auth";
        foreach($this->connected->query($sql) as $row) {
            if($row['user']==$user) {
                //echo $row['id_etudiant'];
                $sql = "SELECT id,groupe,annee_actuelle FROM liste_etudiant";
                foreach ($this->connected->query($sql) as $row1) {
                    //echo $row1['id'] . ' ' . $row1['annee_actuelle'];
                    if($row1['id']==$row['id_etudiant'])
                        return $row1['annee_actuelle'] . ' LFIG ' . $row1['groupe'];
                }
            }
        }
        return "";

    }


    function verif_connect_professeur($user,$password){
        if($id=$this->verif_exist_professeur($user)>0){
            $sql="SELECT id, user, password FROM professeur";
            foreach($this->connected->query($sql) as $row) {
                if ($row['password'] == $password && $row['user']==$user) {
                    return true;
                }
            }
            return false;
        }
    }

    function delete_article($id){
        $sql="DELETE FROM article WHERE id_article=$id;";
        $this->connected->exec($sql);
    }

    function delete_etudiant($id){
        $sql="DELETE FROM liste_etudiant WHERE id=$id;";
        $this->connected->exec($sql);
        $sql="DELETE FROM auth WHERE id_etudiant=$id;";
        $this->connected->exec($sql);
    }

    function delete_professeur($id){
        $sql="DELETE FROM professeur WHERE id=$id;";
        $this->connected->exec($sql);
    }

    function verif_exist_professeur($user){
        $sql="SELECT id, user FROM professeur";
        foreach($this->connected->query($sql) as $row) {
            if($row['user']==$user)
                return $row['id'];
        }
        return 0;
    }

    function search_etudiant_by_mail($email){
        $sql="SELECT id, email FROM liste_etudiant;";
        foreach($this->connected->query($sql) as $row) {
            if($row['email']==$email) {
                return intval($row['id']);
            }
        }
        return intval(0);
    }

    function search_etudiant_by_cin($cin){
        $sql="SELECT id, cin FROM liste_etudiant;";
        foreach($this->connected->query($sql) as $row) {
            if($row['cin']==$cin) {
                return intval($row['id']);
            }
        }
        return intval(0);
    }


    function  modifier_etudiant($user,$nom,$prenom){
        $id="";
        $sql = "SELECT id_etudiant,user FROM auth;";
        foreach($this->connected->query($sql) as $row){
            if($row['user']==$user){
                $id=$row['id_etudiant'];
            }
        }

        $sql = "UPDATE liste_etudiant SET nom='$nom',prenom='$prenom' WHERE id=$id;";
        $this->connected->exec($sql);
    }

    function  modifier_auth_professeur($user,$password){
        $sql = "UPDATE professeur SET password='$password' WHERE user='$user';";
        $this->connected->exec($sql);
    }

    function  modifier_auth_admin($user,$password){
        $sql = "UPDATE admin SET password='$password' WHERE user='$user';";
        $this->connected->exec($sql);
    }

    function  modifier_auth($user,$password){
        $sql = "UPDATE auth SET password='$password' WHERE user='$user';";
        $this->connected->exec($sql);
    }

    function  ajouter_article($user,$titre,$texte){
        $t=$this->connected->quote($texte);
        $sql = "INSERT INTO article (user,titre,texte) VALUES ('$user','$titre',$t);";
        $this->connected->exec($sql);

    }

    function ajouter_etudiant($user,$pass,$email,$nom,$prenom,$cin,$annee_etude,$groupe){
        if($this->verif_exist_etudiant($user)){
            ?>
            <style>
                div.taille {
                    width:500px;
                    margin: auto;
                }
            </style>
            <div class="alert alert-warning fade in taille">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Warning!</strong> user déjà existant dans la base de donnée.
            </div>
            <?php
        }
        else if($this->search_etudiant_by_mail($email)!=0) {
            ?>
            <style>
                div.taille {
                    width:500px;
                    margin: auto;
                }
            </style>
            <div class="alert alert-warning fade in taille">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Warning!</strong> email déjà existant dans la base de donnée.
            </div>
            <?php
        }
        else{
            try {
                $sql = "INSERT INTO liste_etudiant (nom,prenom,cin,email,groupe,annee_actuelle) VALUES ('$nom','$prenom',$cin,'$email',$groupe,$annee_etude);";
                $this->connected->exec($sql);
                $id = $this->search_etudiant_by_mail($email);
                $sql = "INSERT INTO auth (user,password,id_etudiant) VALUES ('$user','$pass',$id);";
                $this->connected->exec($sql);
            } catch (PDOException $e) {
                ?>
                <style>
                    div.taille {
                        width: 500px;
                        margin: auto;
                    }
                </style>
                <div class="alert alert-danger fade in taille">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Error!</strong> A problem has been occurred while submitting your data.
                </div>
                <?php
            }
        }
    }

    function ajouter_professeur($user,$password){
        if(!$this->verif_exist_professeur($user)) {
            $sql = "INSERT INTO professeur (user, password) VALUES ('$user', '$password');";
            try {
                $this->connected->exec($sql);
            } catch (PDOException $e) {
                ?>
                <style>
                    div.taille {
                        width: 500px;
                    }
                </style>
                <div class="alert alert-danger fade in taille">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <strong>Error!</strong> A problem has been occurred while submitting your data.
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
                <strong>Warning!</strong> user déjà existant dans la base de donnée.
            </div>
            <?php
        }
    }
}


?>