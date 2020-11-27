<?php


if(verificationDonnees()){
    echo "Le formulaire est complet.";
    ecrireDansFichier();
}

function ecrireDansFichier(){
    if(!isset($_POST["plainte"])){
        http_response_code(400);
        exit;
    }
    $file = "plaintes.txt"; 
    $plainte = $_POST["plainte"] ;
    file_put_contents($file,$plainte,FILE_TEXT | LOCK_EX) ; 


}
function verificationDonnees(){

    $prenomValide = $nomValide = $mailValide = $ObjetValide = false;

    if($_SERVER["REQUEST_METHOD"] == "POST"){

            $nomValide = nomValide();
            $prenomValide = prenomValide();
            $mailValide = mailValide();
            $ObjetValide = ObjetValide();


    }
    return $prenomValide && $nomValide && $mailValide && $ObjetValide;
}

function nomValide(){
    $nomEstValide = true;
    if(!isset($_POST["nom"])){
        http_response_code(400);
        exit;
    }
    $nom = $_POST["nom"];

    if((empty($nom))){
        echo "<p>Le champ nom est obligatoire</p>";
        $nomEstValide = false;
    }
    if(strlen($nom) > 40){
        echo "<p>Le champ nom ne doit pas dépasser 40 caractères</p>";
        $nomEstValide = false;
    }
    return $nomEstValide;
}

function prenomValide(){
    $prenomEstValide = true;
    if(!isset($_POST["prenom"])){
        http_response_code(400);
        exit;
    }
    $prenom = $_POST["prenom"];

    if((empty($prenom))){
        echo "<p>Le champ prénom est obligatoire</p>";
        $prenomEstValide = false;
    }
    if(strlen($prenom) > 50){
        echo "<p>Le champ prénom ne doit pas dépasser 50 caractères</p>";
        $prenomEstValide = false;
    }
    return $prenomEstValide;
}

function mailValide(){
    $mailEstValide = true;
    if(!isset($_POST["mail"])){
        http_response_code(400);
        exit;
    }
    $mail = $_POST["mail"];

    if(empty($mail)){
        echo "<p>Le champ mail est obligatoire</p>";
        $mailEstValide = false;
    }
    if(stristr($mail,'@') === false){
        echo "<p> Mail incorrect, veuillez recommencer s'il vous plait.</p>";
        $mailEstValide = false;
    }
    return $mailEstValide;
}

function ObjetValide(){
    $objetValide = true;
    if(!isset($_POST["objet"])){
        http_response_code(400);
        exit;
    }
    $objet = $_POST["objet"];

    if(empty($objet)==false){
        echo "<p>Le champ Objet est obligatoire</p>";
        $objetValide = false;
    }
    return $objetValide;
}

?>