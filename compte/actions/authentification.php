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


                if ($users[0]["role"]=="collaborateur" && $userType=="collaborateur") {

                    // Démarre une Session en tant que collaborateur
                    session_start();
                    $_SESSION['session_valide']='OK'; 
                    $_SESSION['user_id']=$users[0]['id'];
                    header("Location: ../../app/views/accueilCollaborateur.php");
                }

                else if ($users[0]["role"]=="entreprise" && $userType=="entreprise"){

                    // Démarre une session en tant qu'entreprise
                    echo "connexion entreprise réussie";
                }
                else{
                    echo "role incorrect";
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