function BestFit(weight,n,capacity) {
//weight : tableau des objets
// n : nombre d objets
// capacity : capacité du bin 

  // Initialiser le nombre de bin à 0
	var res = 0;
    //   Créer un tableau pour stocker l'espace restant dans les bins
    var bin_remp = new Array();

    for (var i = 0; i < n; i++) { // pour chaque objet
           // Trouvez le premier bac qui peut supporter le weight[i]
    	 var j = 0;
           // Initialiser l'espace minimum restant et l'index du meilleur bin

         var min = c + 1;
         var bi = 0;  

         for (j = 0; j < res; j++) {
         	if (bin_remp[j] >= weight[i] && (bin_remp[j] - weight[i])< min){

         		bi = j;
                min = bin_remp[j] - weight[i];
         	}
                    
         }
           // Si aucun bin ne pouvait accueillir weight[i],
           // créer un nouveau bin
            if (min == c + 1){
            	bin_remp[res] = c - weight[i];
                res += 1;
            }
                
            else // Attribuer l'article au meilleur bin
              {
              	bin_remp[bi] -= weight[i];
              }

    }

return res;
    

}

// Test
//genere un nombre aléatoire compris entre min et max
// function entierAleatoire(min, max) {
//   return Math.floor(Math.random() * (max - min + 1)) + min;
// }

// var weight = new Array();
// for (var i = 0; i < 100000; i++) {
//   weight[i] = entierAleatoire(1, 5000);
// }
// let c = entierAleatoire(1, 5000);
// let n = weight.length; //nbr d'items
var weight = [ 2, 5, 4, 7, 1, 3, 8 ];
var c = 10;
var n = weight.length; //nbr d'items

// console.log("Le nombre d'items generes est de " + n);
// console.log("la capacite generee est de " + c);
// console.log("Le nombre de bins requis est de : " + BestFit(weight, n, c));
