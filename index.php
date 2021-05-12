<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Projet Optimisation</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/vanillaSelectBox.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">

   <!-- ChartJS -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style type="text/css">
  div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }
</style>

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-transparent">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="index.php">BIN PACKING</a></h1>
  
      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="index.php">Accueil</a></li>
          <li><a href="#about">Instances</a></li>
          <li><a href="#services">Résultat</a></li>
          <li><a href="#portfolio">Statistiques</a></li>
          
          <li><a href="#contact">Equipe</a></li>

        </ul>
      </nav>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center justify-content-center">
    <div class="container position-relative">
      <h1>Bienvenue sur notre plateforme</h1>
      <h2>Ce projet consiste à implémenter les différentes méthodes exactes et approchées pour la résolution du problème NP-difficile : BIN PACKING</h2>
      <a href="#about" class="btn-get-started scrollto">Commencer maintenant!</a>
    </div>
  </section><!-- End Hero -->

  <main id="main">


<!-- ======= Instances Section ======= -->
    <section id="about" class="about">
      <div class="container">

        <div class="section-title">
          <h2>Choix des instances</h2>
        </div>

<!-- Instances faciles -->

  

  <div class="row justify-content-center align-items-center" id="demo-multiple">
    
   


    <div class="col-lg-6" style="display: inline-block;font-weight: bold;color: grey;">
     Instances faciles :  <select class="form-control" id="brandsMulti" multiple size="1"></select>
    </div>
    <br><br>

     <div class="col-lg-6">
           <div class="btns-active col-lg-12">
      <button class="btn btn-dark" onClick="empty('brandsMulti')">Désélectionner tout</button>
      <button class="btn btn-dark" onClick="setValues('brandsMulti','all')">Sélectionner tout</button>
     <button  class="btn btn-success" onClick="Validate_faciles('brandsMulti')">Valider</button>&nbsp;
&nbsp;
&nbsp;

    </div>
    <div class="btns-inactive" style="display:none";>
      <button class="demo" onClick="init('brandsMulti')">vanillaSelectBox()</button>
    </div>
     </div>

   


    </div>
    

    

<!-- FIN Instances faciles -->


<!-- Instances moyennes -->

  

  <div class="row justify-content-center align-items-center" id="demo-multiple2">
    
   


    <div class="col-lg-6" style="display: inline-block;font-weight: bold;color: grey;">
     Instances moyennes :  <select class="form-control" id="brandsMulti2" multiple size="1"></select>
    </div>
    <br><br>

     <div class="col-lg-6">
           <div class="btns-active2 col-lg-12">
      <button class="btn btn-dark" onClick="empty('brandsMulti2')">Désélectionner tout</button>
      <button class="btn btn-dark" onClick="setValues('brandsMulti2','all')">Sélectionner tout</button>
     <button  class="btn btn-success" onClick="Validate_moyennes('brandsMulti2')">Valider</button>&nbsp;
&nbsp;
&nbsp;
    </div>
    <div class="btns-inactive2" style="display:none";>
      <button class="demo" onClick="init('brandsMulti2')">vanillaSelectBox()</button>
    </div>
     </div>

   


    </div>
    

    

<!-- FIN Instances moyennes -->


<!-- Instances difficiles -->

  

  <div class="row justify-content-center align-items-center" id="demo-multiple3">
    
   


    <div class="col-lg-6" style="display: inline-block;font-weight: bold;color: grey;">
     Instances difficiles :  <select class="form-control" id="brandsMulti3" multiple size="1"></select>
    </div>
    <br><br>

     <div class="col-lg-6">
           <div class="btns-active3 col-lg-12">
      <button class="btn btn-dark" onClick="empty('brandsMulti3')">Désélectionner tout</button>
      <button class="btn btn-dark" onClick="setValues('brandsMulti3','all')">Sélectionner tout</button>
     <button  class="btn btn-success" onClick="Validate_difficiles('brandsMulti3')">Valider</button>&nbsp;
&nbsp;
&nbsp;
    </div>
    <div class="btns-inactive3" style="display:none";>
      <button class="demo" onClick="init('brandsMulti3')">vanillaSelectBox()</button>
    </div>
     </div>

   


    </div>
    

    

<!-- FIN Instances difficiles -->

      </div>
    </section><!-- End Services Section -->   

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title">
          <h2>Résultat obtenue</h2>
           <!-- <button  class="btn btn-light" onClick="Show_dataTable();" style="color: white,font-size:bold;">Afficher résultats</button> -->
        </div>

        <div class="row justify-content-center align-items-center">

<table id="example" class="display nowrap" width="100%"></table>

        </div>

      </div>
    </section><!-- End Services Section -->

    

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="section-title">
          <h2>Statistiques</h2>
        </div>
        <div class="row">
<canvas id="myChart"></canvas>
        </div>
      <br>
      <br>
        <div class="row">
<canvas id="myChart2"></canvas>
        </div>
      <br>
      <br>
     <div class="row">
   <div class="col-lg-4">
     <canvas id="myChart3" height="400"></canvas>
     
   </div>
   <div class="col-lg-4" >
     <canvas id="myChart4" height="400"></canvas>

   </div>
   <div class="col-lg-4" >
     <canvas id="myChart5" height="400"></canvas>
   </div>
     </div>
     <br>
      <br>
     <div class="row">
   <div class="col-lg-4">
     <canvas id="myChart6" height="400"></canvas>

   </div>
   <div class="col-lg-4" >
     <canvas id="myChart7" height="400"></canvas>

   </div>
   <div class="col-lg-4" >
     <canvas id="myChart8" height="400"></canvas>
   </div>
     </div>
<br>
      <br>
     <div class="row">
     <canvas id="myChart9"></canvas>       
     </div>
      </div>
    </section><!-- End Portfolio Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Equipe 14</h2>
          <p>Notre équipe se compose de 4 personnes</p>

        </div>

        <div class="row">
          <div class="footer-links col-lg-6 col-md-6">
              <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">BOUZIDANE Fatima (CE)</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">BOUZAOUIA Hafida Ines</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">BENCHEIKH Chaïma Maroua</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">AMIRAT Rima</a></li>
            </ul>
          </div>

        </div>
      <p style="font-size: 20px;">Voici le lien vers notre code Github : <!-- <div class="social-links text-center text-md-right pt-3 pt-md-0">
       
  </div> -->  <a href="#" class="twitter"><i class="bx bxl-github"></i></a></p>
      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
   <script type="text/javascript" src="assets/js/vanillaSelectBox.js"></script>
<?php 

$dir1    = './assets/Scholl/Scholl_1';
$dir2    = './assets/Scholl/Scholl_2';
$dir3    = './assets/Scholl/Scholl_3';
$files1 = scandir($dir1);
$files2 = scandir($dir2);
$files3 = scandir($dir3);

?>

  
  <script type="text/javascript">
var instances_faciles = <?php echo json_encode($files1); ?>;
var instances_moyennes = <?php echo json_encode($files2); ?>;
var instances_difficiles = <?php echo json_encode($files3); ?>;

</script>
<script>
    // initialiser les instances faciles
    brands = []; ;
    for (var i = 2; i < instances_faciles.length ; i++) {
      brands[i-2] = instances_faciles[i];
    }

    // initialiser les instances moyennes
    brands2 = []; ;
    for (var i = 2; i < instances_moyennes.length ; i++) {
      brands2[i-2] = instances_moyennes[i];
    }

    // initialiser les instances difficiles
    brands3 = []; ;
    for (var i = 2; i < instances_difficiles.length ; i++) {
      brands3[i-2] = instances_difficiles[i];
    }


    let select2 = document.getElementById("brandsMulti");
    let select3 = document.getElementById("brandsMulti2");
    let select4 = document.getElementById("brandsMulti3");

    var option = document.createElement("option");
    option.value = "";
    option.text = "";

var option2 = document.createElement("option");
    option2.value = "";
    option2.text = "";

var option3 = document.createElement("option");
    option3.value = "";
    option3.text = "";

    for (var i = 0;
     i < brands.length;
     i++) {
        var option = document.createElement("option");
        option.value = brands[i];
        option.text = brands[i];
        select2.appendChild(option);
    }


        for (var i = 0;
     i < brands2.length;
     i++) {
        var option2 = document.createElement("option");
        option2.value = brands2[i];
        option2.text = brands2[i];
        select3.appendChild(option2);
    }

    for (var i = 0;
     i < brands3.length;
     i++) {
        var option3 = document.createElement("option");
        option3.value = brands3[i];
        option3.text = brands3[i];
        select4.appendChild(option3);
    }
     
    let selectBox2 = null;
    let selectBox3 = null;
    let selectBox4 = null;

    function setEnable(id, isEnabled) {
        if (id == "brandsMulti" && selectBox2 != null) {
            if (isEnabled) {
                selectBox2.enable();
            } else {
                selectBox2.disable();
            }
        }

        if (id == "brandsMulti2" && selectBox3 != null) {
            if (isEnabled) {
                selectBox3.enable();
            } else {
                selectBox3.disable();
            }
        }

        if (id == "brandsMulti3" && selectBox4 != null) {
            if (isEnabled) {
                selectBox4.enable();
            } else {
                selectBox4.disable();
            }
        }
    }

    function empty(id) {
         if (id == "brandsMulti" && selectBox2 != null) {
            selectBox2.empty();
        }

        if (id == "brandsMulti2" && selectBox3 != null) {
            selectBox3.empty();
        }

        if (id == "brandsMulti3" && selectBox4 != null) {
            selectBox4.empty();
        }
    }

    function doDestroy(id) {
       if (id == "brandsMulti" && selectBox2 != null) {
            selectBox2.destroy();
            let zone = document.getElementById("demo-multiple");
            buttons = zone.querySelector(".btns-active");
            buttons.style.display = "none";
            buttons = zone.querySelector(".btns-inactive");
            buttons.style.display = "block";

        }


        if (id == "brandsMulti2" && selectBox3 != null) {
            selectBox3.destroy();
            let zone = document.getElementById("demo-multiple2");
            buttons = zone.querySelector(".btns-active2");
            buttons.style.display = "none";
            buttons = zone.querySelector(".btns-inactive2");
            buttons.style.display = "block";

        }

         if (id == "brandsMulti3" && selectBox4 != null) {
            selectBox4.destroy();
            let zone = document.getElementById("demo-multiple3");
            buttons = zone.querySelector(".btns-active3");
            buttons.style.display = "none";
            buttons = zone.querySelector(".btns-inactive3");
            buttons.style.display = "block";

        }
    }
    function init(id) {
       if (id == "brandsMulti") {
        
            selectBox2 = new vanillaSelectBox("#brandsMulti", {"disableSelectAll": true, "maxHeight": 200, "search": true ,"translations": { "all": "All", "items": "items","selectAll":"Check All","clearAll":"Clear All"}});
            let zone = document.getElementById("demo-multiple");
            buttons = zone.querySelector(".btns-active");
            buttons.style.display = "block";
            buttons = zone.querySelector(".btns-inactive");
            buttons.style.display = "none";

        }

        if (id == "brandsMulti2") {
        
            selectBox3 = new vanillaSelectBox("#brandsMulti2", {"disableSelectAll": true, "maxHeight": 200, "search": true ,"translations": { "all": "All", "items": "items","selectAll":"Check All","clearAll":"Clear All"}});
            let zone = document.getElementById("demo-multiple2");
            buttons = zone.querySelector(".btns-active2");
            buttons.style.display = "block";
            buttons = zone.querySelector(".btns-inactive2");
            buttons.style.display = "none";

        }

        if (id == "brandsMulti3") {
        
            selectBox4 = new vanillaSelectBox("#brandsMulti3", {"disableSelectAll": true, "maxHeight": 200, "search": true ,"translations": { "all": "All", "items": "items","selectAll":"Check All","clearAll":"Clear All"}});
            let zone = document.getElementById("demo-multiple3");
            buttons = zone.querySelector(".btns-active3");
            buttons.style.display = "block";
            buttons = zone.querySelector(".btns-inactive3");
            buttons.style.display = "none";

        }
    }
    function setValues(id, value) {
       if (id == "brandsMulti" && selectBox2 != null) {
            selectBox2.setValue(value);
        }

        if (id == "brandsMulti2" && selectBox3 != null) {
            selectBox3.setValue(value);
        }

        if (id == "brandsMulti3" && selectBox4 != null) {
            selectBox4.setValue(value);
        }
    }
    function getValues(id) {
        let result = [];
        let collection = document.querySelectorAll("#" + id + " option");
        collection.forEach(function (x) {
            if (x.selected) {
                result.push(x.value);
            }
        });
        return result;
    }


    init("brandsMulti");
    init("brandsMulti2");
    init("brandsMulti3");
         </script>

<!-- <********************************BOUCLES DES INSTANCES********************************>-->

<script type="text/javascript">
  

//  ***************Lecture des instances + lancement fonction ******************

  
  function Validate_faciles(id){

   $(document).ready(function() {
      j=0;
   var table_instances_faciles = getValues(id);
   for (var i = 0 ; i <table_instances_faciles.length ; i++) {
     var inst = table_instances_faciles[i];

    var str; // va contenir la structure en cours 
     
    $.ajax({
   url: "./instance_facile.php",
   method: "POST",
   data: {inst: inst},
   success: function (result) {
    console.log(result);
   }
 });
   

   }

});

  }


//-------------------------------------------------------------------------------
  
//------------------------------------------------------------------------------------
  function Validate_moyennes(id){


   $(document).ready(function() {
   var table_instances_moyennes = getValues(id);
   for (var i = 0 ; i <table_instances_moyennes.length ; i++) {
     var inst = table_instances_moyennes[i];

    var str; // va contenir la structure en cours 
     
    $.ajax({
   url: "./instance_moyenne.php",
   method: "POST",
   data: {inst: inst},
   success: function (result) {
    console.log(result);
   }
 }); 
  
   }

});

  }

//-------------------------------------------------------------------------------
  function Validate_difficiles(id){

   $(document).ready(function() {
   var table_instances_difficiles = getValues(id);
   for (var i = 0 ; i <table_instances_difficiles.length ; i++) {
     var inst = table_instances_difficiles[i];

    var str; // va contenir la structure en cours 
     
    $.ajax({
   url: "./instance.php",
   method: "POST",
   data: {inst: inst},
   success: function (result) {
    console.log("success");
   }
 }); 
  
   }

});

  }

</script> 
<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "optim";
$connexion = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connexion->connect_error) {
  die("Connection failed: " . $connexion->connect_error);
}
  //  echo "Connected successfully";
$sql = "SELECT * FROM `resultats` WHERE 1";
$result = $connexion->query($sql);

$rows = array(); 

if ($result->num_rows > 0) {
  // output data of each row
  $i=0;
  while($row = $result->fetch_assoc()) {
  $rows[$i] = $row;
   $i++;
  }
} else {
  echo "0 results";
}

$connexion->close();
 ?>

<script type="text/javascript">

 // function Show_dataTable(){


  var lignes_bdd = <?php echo json_encode($rows); ?>;
  var dataSet = [];
  
  console.log(lignes_bdd);
  for (var i = 0; i < lignes_bdd.length; i++) {
    if(lignes_bdd[i].type_instance == '0'){
      $type = "Facile";
    }else{
      if(lignes_bdd[i].type_instance == '1'){
      $type = "Moyenne";
    }else{
      $type = "Difficile";
    }
    }
    if (lignes_bdd[i].poids_max == "0" && lignes_bdd[i].poids_min == "0"){
     lignes_bdd[i].poids_max = "";
     lignes_bdd[i].poids_min = "";
    }
    if(lignes_bdd[i].poids_moyen == "0"){
  lignes_bdd[i].poids_moyen = "";
    }
    dataSet[i] = new Array(lignes_bdd[i].nom_instance,$type,lignes_bdd[i].capacite, lignes_bdd[i].nombre_objets,lignes_bdd[i].poids_min,lignes_bdd[i].poids_moyen,lignes_bdd[i].poids_max,lignes_bdd[i].solBB,lignes_bdd[i].tempsBB,lignes_bdd[i].solDP,lignes_bdd[i].tempsDP,lignes_bdd[i].solBF,lignes_bdd[i].tempsBF,lignes_bdd[i].solNF,lignes_bdd[i].tempsNF,lignes_bdd[i].solMet_one,lignes_bdd[i].tempsMet_one,lignes_bdd[i].solMet_two,lignes_bdd[i].tempsMet_two);
  }

$(document).ready(function() {

  

     $('#example').DataTable( {
        data: dataSet,
        columns: [
            { title: "Instance" },
            {title : "Type instance"},
            {title : "Capacité Bin"},
            {title : "Nombre_objets"},
            {title : "Poids min"},
            {title : "Poids moyen"},
            {title : "Poids max"},
            { title: "Solution B&B" },
            { title: "Temps B&B" },
            { title: "Solution Prog-Dyn" },
            { title: "Temps Prog-Dyn" },
            { title: "Solution BestFit" },
            { title: "Temps BestFit" },
            { title: "Solution NextFit" },
            { title: "Temps NextFit" },
            { title: "Solution Méta1" },
            { title: "Temps Méta1" },
            { title: "Solution Méta2" },
            { title: "Temps Méta2" }
        ],
        language: {
            "lengthMenu": "Afficher _MENU_ ligne par page",
            "zeroRecords": "Rien n'a été trouvé - désolé",
            "info": "Affichage de la page _PAGE_ de _PAGES_",
            "infoEmpty": "Aucune information disponible",
            "infoFiltered": "(filtrés à partir de _MAX_ enregistrements au total)",
            "paginate": {
        "first":      "Premier",
        "last":       "Dernier",
        "next":       "Prochain",
        "previous":   "Précédent"
         },
             "search":         "Rechercher :",

        },
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "scrollX": true
      
    } );

});

  //}

 
</script>

<!-- *********************************************************************************** -->
<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "optim";
$connexion = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($connexion->connect_error) {
  die("Connection failed: " . $connexion->connect_error);
}
  //  echo "Connected successfully";
$sql = "SELECT * FROM `resultats` WHERE 1";
$result = $connexion->query($sql);

$instances = array(); 

if ($result->num_rows > 0) {
  // output data of each row
  $i=0;
  while($row = $result->fetch_assoc()) {
  $instances[$i] = $row;
   $i++;
  }
} else {
  echo "0 results";
}

$connexion->close();
 ?>
<!-- *********************************************************************************** -->
<script>
 var instances = <?php echo json_encode($instances); ?>;
 const labels = [];
const methodeBB = [];
const methodeBF = [];
const methodeNF = [];
const methodePD = [];
const methodeMT1 = [];
const methodeMT2 = [];
const methodeBB_nombrebins = [];
const methodeBF_nombrebins = [];
const methodeNF_nombrebins = [];
const methodePD_nombrebins = [];
const methodeMT1_nombrebins = [];
const methodeMT2_nombrebins = [];
 for (var i = 0; i < instances.length; i++) {
   labels[i] = instances[i].nom_instance;
   methodeBB[i] = instances[i].tempsBB;
   methodeBF[i] = instances[i].tempsBF;
   methodeNF[i] = instances[i].tempsNF;
   methodePD[i] = instances[i].tempsDP;
   methodeMT1[i] = instances[i].tempsMet_one;
   methodeMT2[i] = instances[i].tempsMet_two;
   methodeBB_nombrebins[i] = instances[i].solBB;
   methodeBF_nombrebins[i] = instances[i].solBF;
   methodeNF_nombrebins[i] = instances[i].solNF;
   methodePD_nombrebins[i] = instances[i].solDP;
   methodeMT1_nombrebins[i] = instances[i].solMet_one;
   methodeMT2_nombrebins[i] = instances[i].solMet_two;
 }


const backgroundColorVAR = [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ];
const borderColorVAR = [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ];


const data = {
  labels: labels,
  datasets: [
    {
      label: 'Branch&Bound',
      data: methodeBB,
      borderColor: borderColorVAR,
      backgroundColor: backgroundColorVAR,
    },
    {
      label: 'Prog-Dynamique',
      data: methodePD ,
      borderColor: borderColorVAR,
      backgroundColor: backgroundColorVAR,
    }
    ,
    {
      label: 'Best Fit',
      data: methodeBF,
      borderColor: borderColorVAR,
      backgroundColor: backgroundColorVAR,
    },
    {
      label: 'Next Fit',
      data: methodeNF,
      borderColor: borderColorVAR,
      backgroundColor: backgroundColorVAR,
    },
    {
      label: 'Méta-heuristique 1',
      data: methodeMT1,
      borderColor: borderColorVAR,
      backgroundColor: backgroundColorVAR,
    },
    {
      label: 'Méta-heuristique 2',
      data: methodeMT2,
      borderColor: borderColorVAR,
      backgroundColor: backgroundColorVAR,
    }
  ]
};

const config = {
  type: 'line',
  data: data,
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Comparaison du temps d\'exécution entre toutes les méthodes'
      }
    }
  },
};

  var myChart = new Chart(
    document.getElementById('myChart'),
    config
  );
//----------------------------Charte 2--------------------------------


const data2 = {
  labels: labels,
  datasets: [
    {
      label: 'Branch&Bound',
      data: methodeBB_nombrebins,
      borderColor: borderColorVAR,
      backgroundColor: backgroundColorVAR,
    },
    {
      label: 'Prog-Dynamique',
      data: methodePD_nombrebins ,
      borderColor: borderColorVAR,
      backgroundColor: backgroundColorVAR,
    }
    ,
    {
      label: 'Best Fit',
      data: methodeBF_nombrebins,
      borderColor: borderColorVAR,
      backgroundColor: backgroundColorVAR,
    },
    {
      label: 'Next Fit',
      data: methodeNF_nombrebins,
      borderColor: borderColorVAR,
      backgroundColor: backgroundColorVAR,
    },
    {
      label: 'Méta-heuristique 1',
      data: methodeMT1_nombrebins,
      borderColor: borderColorVAR,
      backgroundColor: backgroundColorVAR,
    },
    {
      label: 'Méta-heuristique 2',
      data: methodeMT2_nombrebins,
      borderColor: borderColorVAR,
      backgroundColor: backgroundColorVAR,
    }
  ]
};

const config2 = {
  type: 'line',
  data: data2,
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Comparaison entre le nombre de bins obtenu de toutes les méthodes'
      }
    }
  },
};

  var myChart2 = new Chart(
    document.getElementById('myChart2'),
    config2
  );


  //----------------------------Charte 3--------------------------------


const data3 = {
  labels: labels,
  datasets: [
    {
      label: 'Branch&Bound',
      data: methodeBB,
      borderColor: borderColorVAR,
      backgroundColor: backgroundColorVAR,
    },
    {
      label: 'Prog-Dynamique',
      data: methodePD,
      borderColor: borderColorVAR,
      backgroundColor: backgroundColorVAR,
    }
  ]
};

const config3 = {
  type: 'line',
  data: data3,
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Comparaison du temps d\'exécution entre les méthodes exactes'
      }
    }
  },
};

  var myChart3 = new Chart(
    document.getElementById('myChart3'),
    config3
  );

   //----------------------------Charte 4--------------------------------


const data4 = {
  labels: labels,
  datasets: [
    {
      label: 'Best Fit',
      data: methodeBF,
      borderColor: borderColorVAR,
      backgroundColor: backgroundColorVAR,
    },
    {
      label: 'Next Fit',
      data: methodeNF,
      borderColor: borderColorVAR,
      backgroundColor: backgroundColorVAR,
    }
  ]
};

const config4 = {
  type: 'line',
  data: data4,
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Comparaison du temps d\'exécution entre les heuristiques'
      }
    }
  },
};

  var myChart4 = new Chart(
    document.getElementById('myChart4'),
    config4
  );


   //----------------------------Charte 5--------------------------------


const data5 = {
  labels: labels,
  datasets: [
    {
      label: 'Méta-heuristique 1',
      data: methodeMT1,
      borderColor: borderColorVAR,
      backgroundColor: backgroundColorVAR,
    },
    {
      label: 'Méta-heuristique 2',
      data: methodeMT2,
      borderColor: borderColorVAR,
      backgroundColor: backgroundColorVAR,
    }
  ]
};

const config5 = {
  type: 'line',
  data: data5,
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Comparaison du temps d\'exécution entre les Méta-heuristiques'
      }
    }
  },
};

  var myChart5 = new Chart(
    document.getElementById('myChart5'),
    config5
  );

   //----------------------------Charte 6--------------------------------


const data6 = {
  labels: labels,
  datasets: [
    {
      label: 'Branch & Bound',
      data: methodeBB_nombrebins,
      borderColor: borderColorVAR,
      backgroundColor: backgroundColorVAR,
    },
    {
      label: 'Prog-Dynamique',
      data: methodePD_nombrebins,
      borderColor: borderColorVAR,
      backgroundColor: backgroundColorVAR,
    }
  ]
};

const config6 = {
  type: 'line',
  data: data6,
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Comparaison du nombre de bins entre les méthodes exactes'
      }
    }
  },
};

  var myChart6 = new Chart(
    document.getElementById('myChart6'),
    config6
  );


   //----------------------------Charte 7--------------------------------


const data7 = {
  labels: labels,
  datasets: [
    {
      label: 'Best Fit',
      data: methodeBF_nombrebins,
      borderColor: borderColorVAR,
      backgroundColor: backgroundColorVAR,
    },
    {
      label: 'Next Fit',
      data: methodeNF_nombrebins,
      borderColor: borderColorVAR,
      backgroundColor: backgroundColorVAR,
    }
  ]
};

const config7 = {
  type: 'line',
  data: data7,
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Comparaison du nombre de bins entre les heuristiques'
      }
    }
  },
};

  var myChart7 = new Chart(
    document.getElementById('myChart7'),
    config7
  );

   //----------------------------Charte 8--------------------------------


const data8 = {
  labels: labels,
  datasets: [
    {
      label: 'Méta-heuristique 1',
      data: methodeMT1_nombrebins,
      borderColor: borderColorVAR,
      backgroundColor: backgroundColorVAR,
    },
    {
      label: 'Méta-heuristique 2',
      data: methodeMT2_nombrebins,
      borderColor: borderColorVAR,
      backgroundColor: backgroundColorVAR,
    }
  ]
};

const config8 = {
  type: 'line',
  data: data8,
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Comparaison du nombre de bins entre les Méta-heuristiques'
      }
    }
  },
};

  var myChart8 = new Chart(
    document.getElementById('myChart8'),
    config8
  );


     //----------------------------Charte 9--------------------------------
 // on calcule le temps d execution moyen de toutes les methodes
const donnees = [];
let temps_moy = 0;
for (var i = 0; i < methodeBB.length; i++) {
  temps_moy = temps_moy + parseFloat(methodeBB[i]);
}
 temps_moy = temps_moy/(instances.length);
donnees[0] = temps_moy;
//----------------------------------------------
temps_moy = 0;
for (var i = 0; i < methodePD.length; i++) {
  temps_moy = temps_moy + parseFloat(methodePD[i]);
}
temps_moy = temps_moy/(instances.length);
donnees[1] = temps_moy;
//----------------------------------------------
temps_moy = 0;
for (var i = 0; i < methodeBF.length; i++) {
  temps_moy = temps_moy + parseFloat(methodeBF[i]);
}
temps_moy = temps_moy/(instances.length);
donnees[2] = temps_moy;
//----------------------------------------------

temps_moy = 0;
for (var i = 0; i < methodeNF.length; i++) {
  temps_moy = temps_moy + parseFloat(methodeNF[i]);
}
temps_moy = temps_moy/(instances.length);
donnees[3] = temps_moy;
//----------------------------------------------

temps_moy = 0;
for (var i = 0; i < methodeMT1.length; i++) {
  temps_moy = temps_moy + parseFloat(methodeMT1[i]);
}
temps_moy = temps_moy/(instances.length);
donnees[4] = temps_moy;
//----------------------------------------------

temps_moy = 0;
for (var i = 0; i < methodeMT2.length; i++) {
  temps_moy = temps_moy +parseFloat(methodeMT2[i]);
}
temps_moy = temps_moy/(instances.length);
donnees[5] = temps_moy;
//----------------------------------------------
console.log(donnees);
const backgroundColorVAR2 = [
      'rgba(255, 99, 132, 0.5)',
      'rgba(255, 159, 64, 0.5)',
      'rgba(255, 205, 86, 0.5)',
      'rgba(75, 192, 192, 0.5)',
      'rgba(54, 162, 235, 0.5)',
      'rgba(153, 102, 255, 0.5)',
      'rgba(201, 203, 207, 0.5)'
    ];
   const borderColorVAR2 = [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)',
      'rgb(75, 192, 192)',
      'rgb(54, 162, 235)',
      'rgb(153, 102, 255)',
      'rgb(201, 203, 207)'
    ];
const  labels2 = ["Branch & Bound","Prog-Dynamique","Best Fit","Next Fit","Méta-heuristique 1","Méta-heuristique 2"];
const data9 = {
  labels: labels2,
  datasets: [
    {
      label: 'Temps moyen d\'exécution',
      data: donnees,
      borderColor: borderColorVAR2,
      backgroundColor: backgroundColorVAR2,
    }
  ]
};

const config9 = {
  type: 'bar',
  data: data9,
  options: {
    responsive: true,
    plugins: {
      legend: {
        position: 'top',
      },
      title: {
        display: true,
        text: 'Temps moyen d\'exécution de toutes les instances de chaque méthode'
      }
    }
  },
};

  var myChart9 = new Chart(
    document.getElementById('myChart9'),
    config9
  );
 
</script>

<!-- *********************************************************************************** -->
<!-- *********************************************************************************** -->


<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>   
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>   
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>

</body>

</html>