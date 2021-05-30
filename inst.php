<!DOCTYPE html>
<html>
<head>
	<title>Projet Optimisation</title>

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
   th, td { white-space: nowrap; }

  div.dataTables_wrapper {
        width: 100%;
        margin: 0 auto;
    }
</style>
</head>
<body>
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
	  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top header-transparent" style="background-color: rgb(47,79,79)
;">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="index.php">BIN PACKING</a></h1>
  
      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li><a href="index.php">Accueil</a></li>
          <li class="active"><a href="./inst.php">Instances prédéfinies</a></li>
        </ul>
      </nav>

    </div>
  </header>
<div class="container">
   <br><br><br>
 <br><br><br>
 <br>
 <div class="section-title">
          <h2>Résultat obtenu</h2>
           <!-- <button  class="btn btn-light" onClick="Show_dataTable();" style="color: white,font-size:bold;">Afficher résultats</button> -->
        </div>
  <div class="row justify-content-center align-items-center">

<table id="example2" class="display nowrap" width="100%"></table>

        </div>
</div>
  <script type="text/javascript">

     $(document).ready(function() {
    
    $.ajax({
   url: "./LancerPredef.php",
   method: "POST",
   success: function (result) {
 var dataSet3 = [];
 var res = JSON.parse(result);

 var solBB = JSON.parse(res[0]);
 var tempsBB = JSON.parse(res[1]);
 var solDP = JSON.parse(res[2]);
 var tempsDP = JSON.parse(res[3]);
 var opt = JSON.parse(res[4]);
 var capacites = JSON.parse(res[5]);
 var Nombre_objects = JSON.parse(res[6]);
 var Noms_inst = JSON.parse(res[7]);

console.log( Noms_inst);
 for (var i = 0; i < solBB.length; i++) {
  var nom = Noms_inst[i];
  var capac = capacites[i];
  var nb_Ob = Nombre_objects[i];
  var solution_BB = solBB[i];
  var temps_BB = tempsBB[i];
  var solution_DP = solDP[i];
  var temps_DP = tempsDP[i];
  var opti = opt[i];

 dataSet3[i] = new Array(nom,"Prédefinie",capac,nb_Ob,solution_BB,temps_BB,solution_DP,temps_DP,opti); 
 
 }


     $('#example2').DataTable( {
       
        data: dataSet3,
        columns: [
            { title: "Instance" },
            {title : "Type instance"},
            {title : "Capacité Bin"},
            {title : "Nombre_objets"},
            { title: "Solution B&B" },
            { title: "Temps B&B" },
            { title: "Solution Prog-Dyn" },
            { title: "Temps Prog-Dyn" },
            { title: "Solution Optimale" }
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
        "scrollX": true,
        
    } );
   }
 }); 

});


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
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/3.3.2/js/dataTables.fixedColumns.min.js"></script>
</body>
</html>