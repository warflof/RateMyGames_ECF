// const reponse = await fetch('get_produits.php');
// const produits = await reponse.json();

// const liste = document.getElementById('liste');
// produits.forEach(produit => {
//     const li = document.createElement('li');
//     li.innerHTML = "Titre: " + produit.Titre;
//     liste.appendChild(li);
// });

$.ajax({
    url: 'get_produits.php',
    dataType: 'json',
    success: function(data) {
      var games = data; // stocker les données dans un tableau games
      console.log(games); // vérifier le contenu du tableau
    },
    error: function() {
      console.log('Erreur lors de la récupération des données.');
    }
  });

$(document).ready(function() {

    // Écouter la soumission du formulaire
    $('#filter-form').on('submit', function(event) {
  
      // Empêcher la soumission du formulaire
      event.preventDefault();
  
      // Récupérer les valeurs des champs de filtre
      var filterName = $('#filter-input').val();
      var filterStatus = $('#filter-status').val();
      var filterDate = $('#filter-date').val();
      var filterStyle = $('#filter-style').val();
  
      // Faire une requête AJAX pour récupérer les produits filtrés
      $.ajax({
        url: 'get_produits.php',
        method: 'POST',
        data: {
          filterName: filterName,
          filterStatus: filterStatus,
          filterDate: filterDate,
          filterStyle: filterStyle
        },
        dataType: 'json',
        success: function(products) {
          // Vider la liste de produits actuelle
          $('#liste').empty();
  
          // Ajouter chaque produit à la liste
          $.each(products, function(index, product) {
            $('#liste').append('<div>' + product.Titre + '</div>');
          });
        },
        error: function(jqXHR, textStatus, errorThrown) {
          console.log('Une erreur s\'est produite lors de la récupération des produits filtrés : ' + errorThrown);
        }
      });
  
    });
  
  });
  
  function afficherProduitsFiltres(products) {
    // Vider la liste de produits actuelle
    $('#liste').empty();
  
    // Ajouter chaque produit à la liste
    $.each(products, function(index, product) {
      $('#liste').append('<div>' + product.Titre + '</div>');
    });
  }
  