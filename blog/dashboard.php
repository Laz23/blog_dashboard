<?php
   require_once "functions/auth.php";
   forcer_utilisateur_connecte();
   require_once "menu.php";
   $chemin_php = "functions/compteur.php";
   $chemin_txt = "functions/compteur.txt";
   require_once $chemin_php;
  
   $annee = (int)date("Y");
   $annee_selection = empty($_GET["annee"]) || !isset($_GET['annee']) ? null : (int) $_GET['annee'];
   $mois_selection = empty($_GET['mois']) || !isset($_GET['mois']) ? null : $_GET['mois'];
   $mois = [
         "01" => "Janvier",
         "02" => "Fevrier",
         "03" => "Mars",
         "04" => "Avril",
         "05" => "Mai",
         "06" => "Juin",
         "07" => "Juillet",
         "08" => "Aout",
         "09" => "Septembre",
         "10" => "Octobre",
         "11" => "Novembre",
         "12" => "Décembre"
   ];
   if (!empty($annee_selection) && !empty($mois_selection)){
         $total = nombre_vue_mois($annee_selection,$mois_selection);
         $detail = nombre_vue_detail_mois($annee_selection,$mois_selection);
   }else{
      $total = (int)nombre_vue($chemin_txt);
   }
   //file_get_contents("functions/compteur.txt");
   echo '<br><br><br><br>';
    //require_once "compteur/header.php";
    ?>

   <div class="row">
      <div class="col-md-4">
         <div class="list-group">
            <?php for($i = 0;$i < 5; $i++): ?>
               <a class="list-group-item  <?= $annee - $i === $annee_selection ? 'active' : "";?>" href="dashboard.php?annee=<?= $annee - $i ?>" ><?= $annee - $i ?></a>
               <?php if($annee - $i === $annee_selection): ?>
               <div class="list-group">
                  <?php foreach ($mois as $num => $nom ): ?>
                     <a href="dashboard.php?annee=<?= $annee_selection ?>&mois=<?= $num ?>" class="list-group-item <?= $num == $mois_selection ? "active" : ""?>">
                        <?= $nom ?>
                     </a>
                  <?php endforeach; ?>

               </div>
               <?php endif; ?>
               <?php endfor ?>
         </div>

      </div>
      <div class="col-md-8">
         <div class="card mb-4">
            <div class="card-body">
               <strong style="font-size:3em;"><?= $total ?></strong><br>
               Visite<?= $total > 1 ? "s" : "" ?> total
               
            </div>
         </div>
            
         <?php if(isset($detail)): ?>
            <h2>Détails des visiteurs de mois</h2>
            <table class="table table-striped">
               <thead>
                     <tr>
                        <th>Jour</th>
                        <th>Nobre de visiteurs</th>
                     </tr>
               </thead>

               <tbody>
                  
                  <?php foreach($detail as $ligne):?>
                        <tr>
                           <td><?= $ligne["jour"]?></td>
                        <td><?= $ligne["visiteurs"] ?> visite<?= $ligne["visiteurs"] > 1 ? "s" :""?></td>
                        </tr>
                  <?php endforeach; ?>
               </tbody>


            </table>
         <?php endif; ?>
      </div>

   </div>





   <?php
      require_once "footer.php";
?>
