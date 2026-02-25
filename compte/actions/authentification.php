<?php
    
function verifMdp(){

    include "../../connexionBDD/connexionBDD.php";

    $email = htmlentities($_POST["email"]);
    $MDP = $_POST["password"];
    $userType = $_POST["user_type"];

    // Requete sql pour aller chercher tous les utilisateur pour vérifier plus tard si ils existent
    $SelectUser = $db->prepare("SELECT * FROM user WHERE Email = :email");
    $SelectUser->execute(array(
        "email"=>$email
    )); 
    $users = $SelectUser->fetchAll(PDO::FETCH_ASSOC);

    // Requete sql pour aller chercher toutes les entreprises pour vérifier plus tard si ils existent
    $SelectEntreprise = $db->prepare("SELECT * FROM entreprise WHERE Email = :email");
    $SelectEntreprise->execute(array(
        "email"=>$email
    )); 
    $entreprises = $SelectEntreprise->fetchAll(PDO::FETCH_ASSOC);

        
    // Si le user type est collaborateur, on regarde si le compte existe dans la table entreprise
    if($userType=="collaborateur"){

        if ($users) {

                // Le mot de passe qui est stocké dans la bdd
                $PasswordHash = $users[0]["password"];

                if (password_verify($MDP, $PasswordHash)){

                    if ($users[0]["role"]=="collaborateur" && $userType=="collaborateur") {

                        // Démarre une Session en tant que collaborateur
                        session_start();
                        $_SESSION['session_collaborateur']='OK'; 
                        $_SESSION['user_id']=$users[0]['id'];
                        header("Location: ../../app/views/accueilCollaborateur.php");
                    }
                    // Si les roles ne sont pas les bons
                    else{
                        echo "role incorrect";
                    }
                }

                else {
                    // header("Location: Connexion.php?erreurIdentifiant=identifiantincorrect");
                    echo ("identifiant ou mot de passe incorrect");
                };      
        }
    }

    // Si le user type est entreprise, on regarde si le compte existe dans la table entreprise
    elseif($userType=="entreprise"){

        if ($entreprises) {

                // Le mot de passe qui est stocké dans la bdd
                $PasswordHash = $entreprises[0]["password"];

                if (password_verify($MDP, $PasswordHash)){

                    if ($entreprises[0]["role"]=="entreprise" && $userType=="entreprise"){

                        // Démarre une session en tant qu'entreprise
                        session_start();
                        $_SESSION['session_entreprise']='OK';
                        $_SESSION['entreprise_id']=$entreprises[0]['id']; 
                        header("Location: ../../app/views/accueilEntreprise.php");
                        echo "Session entreprise";

                    }
                    // Si les roles ne sont pas les
                    else{
                        echo "role incorrect";
                    }
                }

                else {
                    // header("Location: Connexion.php?erreurIdentifiant=identifiantincorrect");
                    echo ("identifiant ou mot de passe incorrect");
                };      
        }
    }
      
    else{
        // header("Location: Connexion.php?erreurIdentifiant=identifiantincorrect");
        echo ("Compte inconnu");
    };

  };

verifMdp();

?>