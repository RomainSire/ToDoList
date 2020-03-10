<?php
//var_dump($_POST);
// dans la variable $_POST["tasks"], on reçois tous le/les index des taches à Supprimer

// IL FAUT CONSIDÉRER LE CAS OÙ POST NE SERAIT PAS REMPLI ! (POUR SE PROTÉGER DES PETITS PIRATES !)
if (array_key_exists('tasks', $_POST)) {
  $indexesOfTasksToDelete = $_POST["tasks"];
  //var_dump($indexesOfTasksToDelete);

  // ouvrir le fichier CSV
  $file = fopen('tasks.csv', 'a+');

  // lire toutes les données du CSV, et on les transfore en tableau
  $tasks= [];
  // On fait de même que dans index.php !
  while ($taskData = fgetcsv($file)) {
    array_push($tasks, $taskData);
  }
  fclose($file);
  // Maintenant le tableau $tasks contient toutes mes taches (= tout ce qu'il y a sur le fichier csv)


  // on supprime les bons index du tableau $tasks
  for ($i=0; $i < count($indexesOfTasksToDelete); $i++) {
    array_splice($tasks, ($indexesOfTasksToDelete[$i]-$i), 1);
    // à chaque fois qu'on delete un élément avec splice, les valeurs qui suivent dant le tableau vont être décallées "d'un cran".
    // Donc pour supprimer la bonne valeur, il faut supprimer l'index ($indexesOfTasksToDelete[$i]-$i)
  }
  // CORRECTION : AUTRE POSSIBILITÉ (PLUS SIMPLE À COMPRENDRE)
  // Plutot que de supprimer les valeurs dans le tableau $tasks, on va plutot créer un 2eme tableau $tasksToKeep avec seulement les taches à conserver
  /*
  $tasksToKeep = []; // Tâches qu'on souhaite garder
  foreach($tasks as $taskIndex => $task) { // Je parcoure le tableau des tâches actuelles en récupérant à chaque itération l'index et les données de la tâche
    if (!in_array($taskIndex, $indexesOfTasksToDelete)) { // Si l'index de la tâche n'est pas dans le tableau des indexes de tâches à supprimer
      array_push($tasksToKeep, $task); // Alors je conserve cette tâche dans le tableau des tâches à conserver
    }
  }
  */

  // on réécrit le fichier csv  (voir les commentaires de add.php)
  $file = fopen("tasks.csv", "w");
  foreach ($tasks as $task) {
    fputcsv($file, $task);
  }
  fclose($file);
}

// Redirection vers l'index
header('Location: index.php');
exit();

?>