// var games = [
//   { name: 'A plague Tale: Requiem', likes: Math.floor(Math.random() * 5) + 1, source: 'img/FrontImgGame/A_Plague_Tale_Requiem/A_Plague_Tale_Requiem.gif'},
//   { name: 'Horizon', likes: Math.floor(Math.random() * 5) + 1, source: "img/FrontImgGame/Horizon_Forbiden_West/Horizon_Forbiden_West.gif" },
//   { name: 'New World', likes: Math.floor(Math.random() * 5) + 1, source: "img/FrontImgGame/New_World/New_World.jpg" },
//   { name: 'StarWars: BattleFront II', likes: Math.floor(Math.random() * 5) + 1, source: "img/FrontImgGame/Star_Wars_Battlefront_II/Star_Wars_Battlefront_II.webp" },
//   { name: 'World of Warcraft: DragonFlight', likes: Math.floor(Math.random() * 5) + 1, source: "img/FrontImgGame/World_of_warcraft_DragonFlight/World_of_warcraft_DragonFlight.webp" },


// ];

$(document).ready(function() {
  $.ajax({
    url: 'get_produits.php',
    dataType: 'json',
    success: function(data) {
      var games = data; // stocker les données dans un tableau games
      console.log(games); // vérifier le contenu du tableau

      // Référence à l'élément ul
      var productList = document.getElementById('allGames');

      // Boucle sur chaque produit
      for (var i = 0; i < games.length; i++) {
        // Création de l'élément li
        var productItem = document.createElement('img');
        productItem.className = 'rounded-lg hover:brightness-150 transition duration object-cover';
        productItem.src = "uploads-games/FrontImgGame/" + games[i].image;

        // Ajout de l'élément li à la liste
        productList.appendChild(productItem);
      }
    },
    error: function() {
      console.log('Erreur lors de la récupération des données.');
    }
  });
});




// #####  Fonction de filtrage des produits au clic sur le bouton filtrer  #####

var filterForm = document.getElementById('filter-form');
var askNull = document.getElementById('askNull');


filterForm.addEventListener('submit', function (submit) {
  submit.preventDefault(); // Empêche la page de se rafraîchir

  // Récupération de la valeur du champ de filtre
  var filterValue = document.getElementById('filter-input').value.toLowerCase();

  // Réinitialisation de la liste de produits
  productList.innerHTML = '';

  // Boucle sur chaque produit
  for (var i = 0; i < games.length; i++) {
    // Si le nom du produit contient la valeur du filtre, on l'affiche
    if (games[i].name.toLowerCase().indexOf(filterValue) !== -1) {
      var productItem = document.createElement('img');
      productItem.className = 'rounded-lg hover:brightness-150 transition duration object-cover';
      productItem.src = games[i].image;
      productList.appendChild(productItem);
     
    
    }
  }
}),




  // #####  Fonction de reset des filtres au clic sur le bouton reset  #####

  filterForm.addEventListener('reset', function (reset) 
    {
      reset.preventDefault(); // Empêche la page de se rafraîchir

      // Récupération de la valeur du champ de filtre
      var filterValue = document.getElementById('filter-input');
      filterValue.value = '';

      // Réinitialisation de la liste de produits
      productList.innerHTML = '';

      // Boucle sur chaque produit
      for (var i = 0; i < games.length; i++) 
      {
        // Création de l'élément li
        var productItem = document.createElement('img');
        productItem.className = 'rounded-lg hover:brightness-150 transition duration object-cover ';
        productItem.src = games[i].image;

        // Ajout de l'élément li à la liste
        productList.appendChild(productItem);
      }
    }

  );

// Ouverture de la modale

const filterButton = document.getElementById('FilterButton');
const filterInput = document.getElementById('filterSideBar');
const mainSection = document.getElementById('mainSection');

filterButton.addEventListener('click', () => {
  filterInput.classList.toggle('hidden');
  mainSection.classList.toggle('mx-12');
});

// Fermeture de la modale

const closeModalButton = document.getElementById('closeModalButton');
const modal = document.querySelector('#myModal');

// Ajoute un écouteur d'événement au clic du bouton
closeModalButton.addEventListener('click', () => {
  filterInput.classList.toggle('hidden');
  mainSection.classList.toggle('mx-12');
});


// ############## Les Jeux les + populaires ##############

// Faire un tri à bulle faisant remonter les jeux avec le plus de likes en haut du tableau


// ########### SCROLL HORIZONTAL ########### //

// Test Scroll horizontal
function scrollOther() {
  const scrollable = document.querySelector('#allGames');
  scrollable.scrollLeft -= 160;
}

function scrollRight() {
  const scrollable = document.querySelector('#allGames');
  scrollable.scrollLeft += 160;
}