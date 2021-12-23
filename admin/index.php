<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="noindex"> <!-- NE PAS INDEXER CETTE PAGE -->
        <title>Admin - L'Epicerie Bonne Mine</title>
        <link rel="stylesheet" href="../style.css" type="text/css">
        <meta name="viewport" content="width=device-width">
    </head>
    <body>
        
        <header>  <!-- ##### HEADER ##### -->
            <a href="../">Retour</a>
        </header> <!-- ##### end - HEADER ##### -->
        
        <div id="page">
            <form action="index.php" method="post">
                <label for="fname" >Prénom</label>
                <input type="text" id="fname" name="fname" placeholder="Prénom">
                
                <label for="lname" >NOM</label>
                <input type="text" id="lname" name="lname" placeholder="NOM">

                <label for="email" >Email</label>
                <input type="email" id="email" name="email" placeholder="Email">

                <label for="password_1">Mot de passe</label>
                <input type="password" id="password_1" name="password_1">
                
                <label for="password_2">Confirmation du Mot de passe</label>
                <input type="password" id="password_2" name="password_2">
                
                <button type="submit" name="inscriptionAdmin" value="inscriptionAdmin">inscription</button>
            </form>
            <br><br><br><br>
            <form action="index.php" method="post">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Email">
                
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
                
                <button type="submit" name="connexionAdmin" value="connexionAdmin">connexion</button>
            </form>
        </div>

        <footer>  <!-- ##### FOOTER ##### -->
            <?php include("../footer.html"); ?>
        </footer> <!-- ##### end - FOOTER ##### -->

    </body>
</html>
<?php

try{ // ##### database connection #####
    $mysqlClient = new PDO(
        'mysql:host=localhost;dbname=bonne_mine;charset=utf8',
        'root',
        'root'
    );
}

catch(Exception $e){ // ##### error - database connection #####
    die('Error : '.$e->getMessage());
}

// ##### Validation de l'inscription admin #####
if (isset($_POST['inscriptionAdmin'])){
    if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['email']) && isset($_POST['password_1']) && isset($_POST['password_2'])) {
        if (!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['email']) && !empty($_POST['password_1']) && !empty($_POST['password_2'])) {
            if ($_POST['password_1'] === $_POST['password_2']) {

                $sqlQuery = 'INSERT INTO `admin`(`admin_fname`, `admin_lname`, `admin_email`, `admin_password`) VALUES (:admin_fname, :admin_lname, :admin_email, :admin_password)';
                $stmtAdminInsert = $mysqlClient->prepare($sqlQuery);
                $stmtAdminInsert->execute([
                    'admin_fname' => $_POST['fname'],
                    'admin_lname' => $_POST['lname'],
                    'admin_email' => $_POST['email'],
                    'admin_password' => password_hash($_POST['password_1'], PASSWORD_DEFAULT),
                ]);
                $erreur = 'Le nouveau admin a été créé. Le compte est soumis à une vérification par un admin pour être validé ou rejeté.';
            }
            else {
                $erreur = 'Le mot de passe doit être identique';
            }
        }
        else {
            $erreur = "Merci d'entrer toutes les informations";
        }
    }
    else {
        $erreur = "Merci de remplir tous les champs";
    }
}

// ##### Validation connexion Admin #####
if (isset($_POST['connexionAdmin'])){
    if (isset($_POST['email']) && isset($_POST['password'])) {
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            // ##### Get the whole user table #####
            $sqlQuery = 'SELECT * FROM admin';
            $adminsStatement = $mysqlClient->prepare($sqlQuery);
            $adminsStatement->execute();
            $admins = $adminsStatement->fetchAll();

            foreach ($admins as $admin) {
                if ($admin['admin_email'] === $_POST['email'] && password_verify($_POST['password'], $admin['admin_password'])) {
                    $_SESSION['LOGGED_USER'] = array($admin['admin_id'], $admin['admin_fname'], $admin['admin_lname'], $admin['admin_email']);
                }
            }
        }
        else{
            $erreur = "Merci d'entrer toutes les informations";
        }
    }
    else{
        $erreur = "Merci de remplir tous les champs";
    }
}

if (isset($erreur)){
    echo "Message : " . $erreur . "\n";
}

if (isset($_SESSION['LOGGED_USER'])){
    echo "Bonjour " . $_SESSION['LOGGED_USER'][1] . "\n";
}
?>