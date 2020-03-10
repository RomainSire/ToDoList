<?php
// les données qu'on reçoit du formulaire sont dans $_POST
//var_dump($_POST);

// on veut stocker les infos, mais on ne sais pas encore utiliser les bases de données.
// ==> On va stocker les infos dans un fichier CSV


// TACHES supplémentaires à faire :
// 1 - si l'utilisateur a laissé le champ de titre vide, on n'enregistre pas la tache
// 2 - si l'utilisateur n'a pas rempli de description, la description de la tache doit être "pas de description"
// 3 - Lorsque le traitement est fait, on va rediriger l'utilisateur sur la page principale (index.php)


// SI le titre n'est pas vide (= pas égal à ''), on exécute le code pour ajouter dans notre fichier, sinon on ne fait rien
if (!empty($_POST["title"])) {
  // d'abord on récupère le données de $_POST dans différentes variables
  $title = $_POST["title"];

  $description = $_POST["description"];
  // SI la description n'a pas été remplie, on met à la place 'pas de description'
  if ($description === '') {
    $description = "Pas de description";
  }
  // AUTRE manière d'écrire tout ça pour la description :
  // $description = (empty($_POST["description"])) ? "Tâche sans description" : $_POST["description"];

  // mise en forme de la date !
  $date = $_POST["year"] . '-' . $_POST["month"] . '-' . $_POST["day"];
  $priority = $_POST["priority"];



  // on crée un tableau qui regroupe ces infos (pour pouvoir utiliser ensuite fputcsv)
  $taskData = [$title, $description, $date, $priority];

  // ouvrir/créer un fichier (tasks.csv) --> fonction fopen
  $file = fopen("tasks.csv", "a");

  // écrire dans le fichier une ligne au format CSV avec les informations reçues   --> fonction fputcsv
  fputcsv($file, $taskData);

  // fermer le fichier  --> fonction fclose
  fclose($file);
}

// Redirection vers l'index
// On appelle cette redirection "PRG" pour POST-Redirect-GET
header('Location: index.php');
exit();

?>