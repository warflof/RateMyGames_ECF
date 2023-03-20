// Récupère le formulaire
const form = document.querySelector('form');

// Ajoute un écouteur d'événement sur la soumission du formulaire
form.addEventListener('submit', (event) => {
  // Empêche le formulaire de se soumettre normalement
  event.preventDefault();
  
  // Récupère l'URL de la page à laquelle rediriger l'utilisateur
  const url = 'chemin/vers/la/page/de/destination.php';
  
  // Redirige l'utilisateur
  window.location.href = url;
});
