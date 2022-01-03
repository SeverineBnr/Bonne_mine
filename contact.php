<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>L'Epicerie Bonne Mine - Contact</title>
        <link rel="stylesheet" href="style.css" type="text/css">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
        
        <header>  <!-- ##### HEADER ##### -->
            <?php include("header.html"); ?>
        </header> <!-- ##### end - HEADER ##### -->
        
        <div id="page">
            <!-- L'Epicerie Bonne Mine - Contact <br> -->
            <?php
                if(isset($_POST['contact'])){
                    if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['objet']) && isset($_POST['contenu']) && isset($_POST['civilite'])){
                        if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['objet']) && !empty($_POST['contenu']) && !empty($_POST['civilite'])){
                            $civilite = $_POST['civilite'];
                            $nom = $_POST['nom'];
                            $prenom = $_POST['prenom'];
                            $email = $_POST['email'];
                            $objet = $_POST['objet'];
                            $contenu = $_POST['contenu'];
                            echo $nom . " - " . $prenom . " - " . $email . " - " . $objet . " - " . $contenu . "<br>";
                        }
                        else{
                            echo("Le formulaire de contact n'est pas complet");
                        }
                    }
                    else{
                        echo("Le formulaire de contact n'est pas complet");
                    }
                }
            ?>
            <div class="section_horaires">
                <div class="titre_horaires">Nos horaires d'ouverture :<br></div>
                <br><div class="gras">mardi - mercredi - jeudi :</div> 8h30 - 12h30 / 15h30 - 18h<br><br>
                <div class="gras">vendredi :</div> 9h30 - 12h30 / 15h30 - 18h<br><br>
                <div class="gras">samedi - dimanche :</div> 9h30 - 12h30 / 15h30 - 18h<br>
            </div>

            <form action="contact.php" method="POST"> 
                <div class="titre_formulaire">Écrivez-nous<br></div>
                <div class="description_formulaire">Une remarque ? Une question ? N'hésitez pas à nous contacter<br><br></div>
                <input type="radio" name="civilite" id="m" value="M.">
                <label class="gras" for="m">M.</label>

                <input type="radio" name="civilite" id="mme" value="Mme">
                <label class="gras" for="mme">Mme</label><br><br>

                <label class="gras" for="nom">Nom :</label><br>
                <input type="text" name="nom" id="nom"><br><br>
                
                <label class="gras" for="prenom">Prénom :</label><br>
                <input type="text" name="prenom" id="prenom"><br><br>
                
                <label class="gras" for="email">Email :</label><br>
                <input type="email" name="email" id="email" required placeholder="exemple@email.com"><br><br>

                <label class="gras" for="objet">Objet :</label><br>
                <input type="text" name="objet" id="objet"><br><br>

                <label class="gras" for="contenu">Contenu de votre message :</label><br>
                <textarea name="contenu" id="contenu"></textarea><br><br>
            
                <button type="submit" name="contact" value="Envoyer">Envoyer</button>
            </form>
            
            
            <?php
                ini_set("SMTP", "ssl0.ovh.net");
                ini_set("sendmail_from", "severine@benier.dev");
                
                $headers ='From: severine@benier.dev'."\n";
                $headers .='Reply-To: severine@benier.dev'."\n";
                $headers .='Content-Type: text/plain; charset="iso-8859-1"'."\n";
                $headers .='Content-Transfer-Encoding: 8bit';
                $headers.= 'Content-Type: text/html; charset="utf-8"'."\n";
                
                $objetMail = $civilite . " " . $prenom . "  " . $nom . " vous a contacté";
                $contenuMail = "Objet : ". $objet . "\n\n" . "Message : " . $contenu;
                
                if (
                    mail(
                        'severine@benier.dev', 
                        $objetMail, 
                        $contenuMail, 
                        $headers
                    ) 
                ){
                    //echo 'ok';
                    
                } else {
                    echo 'erreur';
                }
                //echo "Check your email now....<br/>";
            ?>
            Merci de nous avoir contactés. Nous vous contacterons très bientôt.
        </div>

        <footer>  <!-- ##### FOOTER ##### -->
            <?php include("footer.html"); ?>
        </footer> <!-- ##### end - FOOTER ##### -->

    </body>
</html>