<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>L'Epicerie Bonne Mine - Contact</title>
        <link rel="stylesheet" href="style/style.css" type="text/css">
        <meta name="viewport" content="width=device-width">

        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="57x57" href="img/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="img/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="img/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="img/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="img/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="img/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="img/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="img/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="img/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="img/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
        <link rel="manifest" href="img/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="img/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

        <!-- Matomo -->
        <script>
            var _paq = window._paq = window._paq || [];
            /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
            _paq.push(['trackPageView']);
            _paq.push(['enableLinkTracking']);
            (function() {
                var u="//analytics.lepiceriebonnemine.fr/";
                _paq.push(['setTrackerUrl', u+'matomo.php']);
                _paq.push(['setSiteId', '1']);
                var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
                g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
            })();
        </script>
        <!-- End Matomo Code -->

        
    </head>
    <body>
        
        <header>  <!-- ##### HEADER ##### -->
            <?php include("header.html"); ?>
        </header> <!-- ##### end - HEADER ##### -->
        
        <div id="page">
            <!-- L'Epicerie Bonne Mine - Contact <br> -->
            <br><br><br><strong>Site en construction</strong><br><br><br>
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
                            
                            ini_set("SMTP", "ssl0.ovh.net");
                            ini_set("sendmail_from", "contact@lepiceriebonnemine.fr");
                            
                            $headers ='From: '.$email."\n";
                            $headers .='Reply-To: contact@lepiceriebonnemine.fr'."\n";
                            $headers .='Content-Type: text/plain; charset="iso-8859-1"'."\n";
                            $headers .='Content-Transfer-Encoding: 8bit';
                            $headers.= 'Content-Type: text/html; charset="utf-8"'."\n";
                            
                            $objetMail = $civilite . " " . $prenom . " " . $nom . " vous a contacté depuis lepiceriebonnemine.fr";
                            $contenuMail =  "Objet : ". $objet . "\n\n" . 
                                            "Message : " . $contenu;
                            
                            if (
                                mail(
                                    'paul@benier.dev', 
                                    $objetMail, 
                                    $contenuMail, 
                                    $headers
                                ) 
                            ){
                                echo '<script type="text/javascript">
                                        alert("Merci de nous avoir contactés.\n\n' . 
                                            $prenom . ' ' . $nom . '\n' . 
                                            $email . '\n' . 
                                            $objet . '\n' . 
                                            $contenu . '");
                                    </script>';
                                
                            } else {
                                echo 'erreur';
                            }
                            //echo "Check your email now....<br/>";
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
                <br><div class="gras">mardi - mercredi - jeudi :</div> 8h30 - 12h30 / 15h30 - 18h30<br><br>
                <div class="gras">vendredi :</div> 9h30 - 12h30 / 15h30 - 19h30<br><br>
                <div class="gras">samedi - dimanche :</div> 9h30 - 12h30<br>
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
            
        </div>

        <footer>  <!-- ##### FOOTER ##### -->
            <?php include("footer.html"); ?>
        </footer> <!-- ##### end - FOOTER ##### -->

    </body>
</html>