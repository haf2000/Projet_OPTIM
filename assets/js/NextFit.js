// Implementation de l'algorithme next-fit
// Retourne le nombre de bins requis pour un nombre d'items n

//genere un nombre aléatoire compris entre min et max
function entierAleatoire(min, max) {
  return Math.floor(Math.random() * (max - min + 1)) + min;
}

function nextFit(weight, nbrit, capacity) {
  // initialiser le res nbr de bins
  // act_cap represente la capacité actuelle dans le bin actuel
  let res = 1,
    act_cap = capacity;

  var tabres; //matrice (item,bin)
  for (let i = 0; i < nbrit; i++) {
    //parcourir les items
    // Si l'item ne peut etre place dans le bin acutel
    if (weight[i] > act_cap) {
      res++; // ajouter un nouveau bin
      act_cap = capacity - weight[i]; //màj la capacité actuelle
      tabres = unshift(cpt, res);
      cpt++;
    } //on le place dans le bin
    else act_cap -= weight[i];
    tabres = unshift(i, res);
    ++cpt;
  }
  console.log(tabres);
  return res; //retourner le nbr de bins requis
}

// Test

//let weight = [2, 5, 4, 7, 1, 3, 8];
// var w = new Array();
// for (var i = 0; i < 100000; i++) {
//   w[i] = entierAleatoire(1, 5000);
// }
// let cap = entierAleatoire(1, 5000);
// let nn = w.length; //nbr d'items
// console.log("Le nombre d'items generes est de " + nn);
// console.log("la capacite generee est de " + cap);
// console.log("Le nombre de bins requis est de : " + nextFit(w, nn, cap));
