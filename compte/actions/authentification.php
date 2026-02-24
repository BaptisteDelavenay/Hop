<?php
    
function verifMdp(){

    include "../../connexionBDD/connexionBDD.php";

    $email = htmlentities($_POST["email"]);
    $MDP = $_POST["password"];
    $userType = $_POST["user_type"];

    $SelectUser = $db->prepare("SELECT * FROM user WHERE Email = :email");
    $SelectUser->execute(array(
        "email"=>$email
    )); 
    $users = $SelectUser->fetchAll(PDO::FETCH_ASSOC);
        
        
        if ($users) {

            $PasswordHash = $users[0]["password"];

            if (password_verify($MDP, $PasswordHash)){

                // echo "<pre>";
                // print_r($users[0]);
                // echo "</pre>";
                if ($users[0]["role"]=="collaborateur" && $userType=="collaborateur") {

                    // Démarre une Session en tant qu'entreprise
                    echo "connexion collaborateur réussie";
                }

                else if ($users[0]["role"]=="entreprise" && $userType=="entreprise"){

                    // Démarre une session en tant que collaborateur
                    echo "connexion entreprise réussie";
                }
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