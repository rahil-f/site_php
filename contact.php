

<?php 
   $ma_variable = "..............";
   include("haut_de_page.php");
    ?>
<section class="bg-primary" id="about">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 col-lg-offset-2 text-center">
            <h2 class="section-heading">............................</h2>
            <hr class="light">
            <p class="text-faded">bienvenue dans contact!</p>
            <a href="#" class="btn btn-default btn-xl">aller a contact!</a>
         </div>
      </div>
   </div>
</section>
<section id="services">
   <div class="container">
      <div class="row">
         <div class="col-lg-12 text-center">
            <h2 class="section-heading">contact</h2>
            <hr class="primary">
            <?php 
               if (isset($_POST["mon_prenom"]) && isset($_POST["mon_email"]) && isset($_POST["mon_message"]) && !empty(htmlspecialchars($_POST["mon_prenom"])) && !empty(htmlspecialchars($_POST["mon_email"])) && !empty(htmlspecialchars($_POST["mon_message"])))
               {
               		if (filter_var(htmlspecialchars($_POST["mon_email"]), FILTER_VALIDATE_EMAIL))
               		{
              		 echo htmlspecialchars($_POST["mon_prenom"])." a envoyer un email avec l'email: ".htmlspecialchars($_POST["mon_email"])." avec comme Message: ".htmlspecialchars($_POST["mon_message"]);
               		}	
              		 else
              		 echo "adresse email pas valide maggle";
               }
               ?>
            <form action="contact.php#services" method="post">
               <input placeholder="Prénom" name="mon_prenom">
               <input placeholder="Email" name="mon_email">
               <input placeholder="Message" name="mon_message">
               <input type="submit" value="Envoyer">
            </form>
         </div>
      </div>
   </div>
   <div class="container">
      <div class="row">
         <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box">
               <i class="fa fa-4x fa-diamond wow bounceIn text-primary"></i>
               <h3>..............</h3>
               <p class="text-muted">........................................................</p>
            </div>
         </div>
         <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box">
               <i class="fa fa-4x fa-paper-plane wow bounceIn text-primary" data-wow-delay=".1s"></i>
               <h3>..............</h3>
               <p class="text-muted">..........................................</p>
            </div>
         </div>
         <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box">
               <i class="fa fa-4x fa-newspaper-o wow bounceIn text-primary" data-wow-delay=".2s"></i>
               <h3>..............</h3>
               <p class="text-muted">..........................................</p>
            </div>
         </div>
         <div class="col-lg-3 col-md-6 text-center">
            <div class="service-box">
               <i class="fa fa-4x fa-heart wow bounceIn text-primary" data-wow-delay=".3s"></i>
               <h3>..............</h3>
               <p class="text-muted">........................................................</p>
            </div>
         </div>
      </div>
   </div>
</section>
<?php
   include("pied_de_page.php");
   ?>

