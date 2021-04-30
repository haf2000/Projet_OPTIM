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
     <button  class="btn btn-success" onClick="let table_instances_faciles = getValues('brandsMulti');console.log(table_instances_faciles);">Valider</button>&nbsp;
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
     <button  class="btn btn-success" onClick="let table_instances_moyennes = getValues('brandsMulti2');console.log(table_instances_moyennes);">Valider</button>&nbsp;
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
     <button  class="btn btn-success" onClick="let table_instances_difficiles = getValues('brandsMulti3');console.log(table_instances_difficiles);">Valider</button>&nbsp;
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
          <p>Description Résultat</p>
        </div>

        <div class="row justify-content-center align-items-center">

<table id="example" class="display" width="100%"></table>

        </div>

      </div>
    </section><!-- End Services Section -->

    

    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="section-title">
          <h2>Statistiques</h2>
          <p>Graphes ..etc</p>
        </div>

        <div class="row">
        

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
<!--  ************************* DATATABLES ******************-->
<script type="text/javascript">
  
  var dataSet = [
    [ "N1C1W1", "65", "66", "54", "54", "66", "55", "65", "66", "54", "54", "66", "55"]
];
 
$(document).ready(function() {
    $('#example').DataTable( {
        data: dataSet,
        columns: [
            { title: "Instance" },
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
        ]
      
    } );
} );
</script> 


  
</script>
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