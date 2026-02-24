<?php
    
function verifMdp(){

    include "../connexionBDD/connexionBDD.php";

    $email = htmlentities($_POST["email"]);
    $MDP = $_POST["password"];

    $SelectUser = $db->prepare("SELECT * FROM user WHERE Email = :email");
    $SelectUser->execute(array(
        "email"=>$email
    )); 
    $users = $SelectUser->fetchAll(PDO::FETCH_ASSOC);
        
        
        if ($users) {

            $PasswordHash = $users[0]["password"];

            if (password_verify($MDP, $PasswordHash)){

                if ($users[0]["statut"]=="admin") {

                    // Démarre une Session en tant qu'admin
                    session_start();
                    $_SESSION['session_admin_valide']='OK';
                    $_SESSION["login"] = $_POST["login"];
                    $_SESSION["password"] = $_POST["password"];
                    header("Location: ../Admin/admin.php");
                }

                else {

                    // démare une session normale
                    session_start();
                    $_SESSION["login"] = $_POST["login"];
                    $_SESSION["password"] = $_POST["password"];
                    $_SESSION['session_valide']='OK'; 
                    header("Location: ../reservation/liste.php");
                };


            }

            else {
                // header("Location: Connexion.php?erreurIdentifiant=identifiantincorrect");
                echo ("identifiant incorrect");
            };
            
    }
    
    else{
        // header("Location: Connexion.php?erreurIdentifiant=identifiantincorrect");
        echo ("identifiant incorrect");
    };

  };

verifMdp();

?>