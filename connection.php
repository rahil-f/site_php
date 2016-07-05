
<?php 
   session_start();
   if (!isset($_SESSION["est_connecte"]))
      $_SESSION["est_connecte"] = false;
 define('PREFIX_SALT', 'prison');
  define('SUFFIX_SALT', 'break');
   $ma_variable = "..............";
   include("haut_de_page.php");
    ?>
<section class="bg-primary" id="about">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 col-lg-offset-2 text-center">
            <h2 class="section-heading">...............................</h2>
            <hr class="light">
            <p class="text-faded">bienvenue dans connection!</p>
            <a href="inscription.php" class="btn btn-default btn-xl">aller a l'inscription!</a>
         </div>
      </div>
   </div>
</section>
<section id="services">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 text-center">
            <h2 class="section-heading">connection</h2>
            <hr class="primary">
            <?php 
            $result = 0;
            {
               if (isset($_POST["email"]) && isset($_POST["pass1"]))
               {  
                  if (!empty(htmlspecialchars($_POST["email"])) && !empty(htmlspecialchars($_POST["pass1"])))
                  {
                       
                  }
                  else
                  {
                     echo "tout les champs ne sont pas plein";
                     $result = 0;
                  }
               }
            }
            if(isset($_POST['email']))
               $email = htmlspecialchars($_POST['email']);
            else      
               $email = "";
             if(isset($_POST['pass1']))
             {     
               $password = htmlspecialchars($_POST['pass1']);
            }
            else      
               $password = "";
            if (isset($_POST["email"]) && isset($_POST["pass1"]) && !empty(htmlspecialchars($_POST["email"])) && !empty(htmlspecialchars($_POST["pass1"])))
            {
               try
               {
                  $db = new PDO('mysql:host=localhost;dbname=compte_perso;charset=utf8', 'root', '');
               }
               catch(Exception $e)
               {
                  die('Erreur : '.$e->getMessage());
               }
                $query=$db->prepare('SELECT prenom, nom, age, email, password FROM compte WHERE email = :email');
                 $query->bindValue(':email',$_POST["email"], PDO::PARAM_STR);
                 $query->execute();
                 $data=$query->fetch();
               if ($data["password"] == sha1(PREFIX_SALT.$password.SUFFIX_SALT))
               {
                  $_SESSION["est_connecte"] = true;
                  $_SESSION['pseudo'] = $data["email"];
                  $_SESSION['prenom'] = $data["prenom"];
                  $_SESSION['nom'] = $data["nom"];
               } 
               else
               {
                   $message = '<p>Une erreur s\'est produite 
                   pendant votre identification.<br /> Le mot de passe ou le pseudo 
                        entré n\'est pas correcte.</p><p>Cliquez <a href="http://localhost/ok/mon_site/connection.php">ici</a> 
                   pour revenir à la page précédente
                   <br /><br />Cliquez <a href="http://localhost/ok/mon_site/index.php">ici</a> 
                   pour revenir à la page d accueil</p>';
               }
               $query->CloseCursor();
               if (isset($message))
                  {
                     echo $message.'</div>';
                  }
            }
           ?>
           <?php
         if ($_SESSION["est_connecte"] == true)
         {
            echo '<p>Bienvenue '.$_SESSION["prenom"]." ".$_SESSION["nom"].', 
                  vous êtes maintenant connecté!</p>
                  <p>Cliquez <a href="http://localhost/ok/mon_site/index.php">ici</a> 
                  pour revenir à la page d accueil</p>';  
         ?>
         <a href="deconnection.php"> <input type="button" value="Deconnection"> </a>
         <?php
        }
           ?>
           <?php 
           if ($_SESSION["est_connecte"] == false) 
            {  ?>
            <form action="connection.php#services" method="post">
               <label>Email: <input placeholder="email" name="email" value=""></label>
               </br>
               <label>Password: <input type="password" name="pass1" value=""></label>
               </br>
               <input type="submit" value="Ce connecter">
               </br></br>
               Si vous n'avez pas de compte créé en un : <a href="http://localhost/ok/mon_site/inscription.php">inscription</a>
               <?php } ?>
            </form>
         </div>
      </div>
   </div>
   <div class="container">
      <div class="row">
         <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box">
               <i class="fa fa-4x fa-diamond wow bounceIn text-primary"></i>
               <h3>.............</h3>
               <p class="text-muted">...................................................</p>
            </div>
         </div>
         <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box">
               <i class="fa fa-4x fa-paper-plane wow bounceIn text-primary" data-wow-delay=".1s"></i>
               <h3>...............</h3>
               <p class="text-muted">......................................................</p>
            </div>
         </div>
         <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box">
               <i class="fa fa-4x fa-newspaper-o wow bounceIn text-primary" data-wow-delay=".2s"></i>
               <h3>..............</h3>
               <p class="text-muted">......................................................</p>
            </div>
         </div>
         <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box">
               <i class="fa fa-4x fa-heart wow bounceIn text-primary" data-wow-delay=".3s"></i>
               <h3>.........................</h3>
               <p class="text-muted">......................................</p>
            </div>
         </div>
      </div>
   </div>
</section>
<?php
   include("pied_de_page.php");
   ?>

