<?php
session_start();
if ($_SESSION["est_connecte"] == true)
  exit(header("location: connection.php#services"));
define('PREFIX_SALT', 'prison');
  define('SUFFIX_SALT', 'break');
 include("config.php");
 ?>


<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $nom_du_site; ?></title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="css/animate.min.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/creative.css" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">..............</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top"><?php echo $nom_du_site; ?></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    $i = 0;
                    while ($i < count($mon_menu))
                    {
                        echo '<li><a class="page-scroll" href="'.$mon_menu_url[$i].'">';
                        echo $mon_menu[$i];
                        echo '</a></li>';
                        $i++;
                    }
                    ?>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                
                <?php
                try
               {
                  $bdd = new PDO('mysql:host=localhost;dbname=compte_perso;charset=utf8', 'root', '');
               }
               catch(Exception $e)
               {
                  die('Erreur : '.$e->getMessage());
               }
                $result = 0;
                if (isset($_POST["mon_prenom"]) && isset($_POST["mon_nom"]) && isset($_POST["age"]) && isset($_POST["email"]) && isset($_POST["email2"]) && isset($_POST["pass1"]) && isset($_POST["pass2"]))
               {  
                  if (!empty(htmlspecialchars($_POST["mon_prenom"])) && !empty(htmlspecialchars($_POST["mon_nom"])) && !empty(htmlspecialchars($_POST["age"])) && !empty(htmlspecialchars($_POST["email"])) && !empty(htmlspecialchars($_POST["email2"])) && !empty(htmlspecialchars($_POST["pass1"])) && !empty(htmlspecialchars($_POST["pass2"])))
                  {
                     if (filter_var((htmlspecialchars($_POST["email"])), FILTER_VALIDATE_EMAIL) && filter_var((htmlspecialchars($_POST["email2"])), FILTER_VALIDATE_EMAIL) && (htmlspecialchars($_POST["email"]) == htmlspecialchars($_POST["email2"])))
                     {
                        if (htmlspecialchars($_POST["pass1"]) == htmlspecialchars($_POST["pass2"]))
                        {
                           if (htmlspecialchars($_POST["age"]) <= '150' && htmlspecialchars($_POST["age"]) >= '0')
                           { 
                            $email = htmlspecialchars($_POST["email"]);
                            $email_Exist = $bdd->prepare("SELECT email FROM compte WHERE email = :email");
                            $email_Exist->bindValue('email', $email, PDO::PARAM_STR);
                            $email_Exist->execute();
                            $emailINbdd = $email_Exist->rowCount();
                            $result = 1;
                          }
                          else
                          {  
                            echo "champs age invalide";
                            $result = 0;
                         }
                        }
                        else
                        {
                           echo "mot de passe non identique";
                           $result = 0;
                        }
                     }
                     else
                     {
                        echo "Adresse email non valide ou elle ne sont pas identique";
                        $result = 0;
                     }
                  }
                  else
                  {
                     echo "tout les champs ne sont pas plein";
                     $result = 0;
                  }
               }
            $hashed_password = 0;
            if (isset($_POST['mon_nom']))
               $nom = htmlspecialchars($_POST['mon_nom']);
            else      
               $nom = "";
            if (isset($_POST['mon_prenom']))
               $prenom = htmlspecialchars($_POST['mon_prenom']);
            else 
              $prenom = "";
            if (isset($_POST['email']))
               $email = htmlspecialchars($_POST['email']);
            else      
               $email = "";
            if (isset($_POST['age']))
               $age = htmlspecialchars($_POST['age']);
            else      
               $age = "";
             if (isset($_POST['pass1']))
             {     
               $password = htmlspecialchars($_POST['pass1']);
               $hashed_password = sha1(PREFIX_SALT.$password.SUFFIX_SALT);
            }
            else      
               $password = "";
            if (isset($_POST["mon_prenom"]) && isset($_POST["mon_nom"]) && isset($_POST["age"]) && isset($_POST["email"]) && isset($_POST["email2"]) && isset($_POST["pass1"]) && isset($_POST["pass2"]) && filter_var((htmlspecialchars($_POST["email"])), FILTER_VALIDATE_EMAIL) && filter_var((htmlspecialchars($_POST["email2"])), FILTER_VALIDATE_EMAIL) && (htmlspecialchars($_POST["email"]) == htmlspecialchars($_POST["email2"])) && !empty(htmlspecialchars($_POST["mon_prenom"])) && !empty(htmlspecialchars($_POST["mon_nom"])) && !empty(htmlspecialchars($_POST["age"])) && !empty(htmlspecialchars($_POST["email"])) && !empty(htmlspecialchars($_POST["email2"])) && !empty(htmlspecialchars($_POST["pass1"])) && !empty(htmlspecialchars($_POST["pass2"])) && htmlspecialchars($_POST["pass1"]) == htmlspecialchars($_POST["pass2"]) && htmlspecialchars($_POST["age"]) <= '150' && htmlspecialchars($_POST["age"]) >= '0')
            {
              if ($emailINbdd == 0)
              {
                $bdd->exec("INSERT INTO compte(prenom, nom, age, email, password) VALUES('$prenom', '$nom', '$age', '$email', '$hashed_password')");
                if (isset($_POST["mon_prenom"]) && isset($_POST["mon_nom"]) && isset($_POST["age"]) && isset($_POST["email"]) && isset($_POST["email2"]) && isset($_POST["pass1"]) && isset($_POST["pass2"]) && filter_var((htmlspecialchars($_POST["email"])), FILTER_VALIDATE_EMAIL) && filter_var((htmlspecialchars($_POST["email2"])), FILTER_VALIDATE_EMAIL) && (htmlspecialchars($_POST["email"]) == htmlspecialchars($_POST["email2"])) && !empty(htmlspecialchars($_POST["mon_prenom"])) && !empty(htmlspecialchars($_POST["mon_nom"])) && !empty(htmlspecialchars($_POST["age"])) && !empty(htmlspecialchars($_POST["email"])) && !empty(htmlspecialchars($_POST["email2"])) && !empty(htmlspecialchars($_POST["pass1"])) && !empty(htmlspecialchars($_POST["pass2"])) && htmlspecialchars($_POST["pass1"]) == htmlspecialchars($_POST["pass2"]) && htmlspecialchars($_POST["age"]) <= '150' && htmlspecialchars($_POST["age"]) >= '0')
                {
                    echo 'votre compte a bien ete cree!';
                    //$mail = htmlspecialchars($_POST["email"]);
                    //if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail))
                    //{
                    //  $passage_ligne = "\r\n";
                    //}
                    //else
                    //{
                    //  $passage_ligne = "\n";
                    //}
                    //$message_txt = "envoi auto pour valider l'email.";
                    //$message_html = "<html><head></head><body><b>envoi email</b>, auto pour valider email.</body></html>";
                    //$boundary = "-----=".md5(rand());
                    //$sujet = "Hey mon ami !";
                    //$header = "From: \"WeaponsB\"<felixrahil@yahoo.fr>".$passage_ligne;
                    //$header.= "Reply-to: \"WeaponsB\" <felixrahil@yahoo.fr>".$passage_ligne;
                    //$header.= "MIME-Version: 1.0".$passage_ligne;
                    //$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
                    //$message = $passage_ligne."--".$boundary.$passage_ligne;
                    //$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
                    //$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
                    //$message.= $passage_ligne.$message_txt.$passage_ligne;
                    //$message.= $passage_ligne."--".$boundary.$passage_ligne;
                    //$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
                    //$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
                    //$message.= $passage_ligne.$message_html.$passage_ligne;
                    //$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
                    //$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
                    //mail($mail,$sujet,$message,$header);
                }
              }
              else
              {
                 echo "adresse email deja crée";
              }
            }            
           ?>
           <style>
           input
           {
            color: black;
           }
           </style>
            <form action="inscription.php#services" method="post">
               <label>Prenom: <input placeholder="Prenom" name="mon_prenom"></label>
               </br>
               <label>Nom: <input placeholder="Nom" name="mon_nom"></label>
               </br>
               <label>Age: <input placeholder="Age" name="age"></label>
               </br>
               <label>Email: <input placeholder="email" name="email" value=""></label>
               </br>
               <label>Validation Email: <input placeholder="validation email" name="email2" value=""></label>
               </br>
               <label>Password: <input type="password" name="pass1" value=""></label>
               </br>
                  <label>Validation Password: <input type="password" name="pass2" value=""></label>
               </br>
               <input type='checkbox' name='case' value='on' checked> cocher la case pour accepter le contrat.
               </br>
               <input type="submit" value="Envoyer">
            </form>
            </div>
        </div>
    </header>
<?php
include("pied_de_page.php");
?>