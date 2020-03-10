<?php
// Variable Tableau contenant le nom des mois
$months = [
  "Janvier",
  "Février",
  "Mars",
  "Avril",
  "Mai",
  "Juin",
  "Juillet",
  "Aout",
  "Septembre",
  "Octobre",
  "Novembre",
  "Décembre"
];

// Variable contenant l'année actuelle
$currentYear = date('Y');

// Renvoi un objet de type DateTime qui représente la date du jour
$today = date_create();


// Ouvre le fichier CSV
$file = fopen('tasks.csv', 'a+');
// on crée un gros tableau vide dans lequel sera stocké toutes les infos
$tasks= [];
// La fonction fgetcsv, à chaque fois qu'elle est appelée, renvoie la ligne suivante du fichier, quand il n'y a plus de ligne, renvoie FALSE
// LIRE le fichier CSV  (TANT que le fonction de lecture ne renvoie pas de FALSE)
while ($taskData = fgetcsv($file)) {
  // On stocke le tableau représentant la tache lue ($taskData) dans le tableau de toutes les tâches ($tasks)
  array_push($tasks, $taskData);
}
// Fermer le fichier
fclose($file);


// var_dump($tasksData[1][1]);
//
// var_dump($tasksData);



// Lancement de la VUE
include("index.phtml");

?>

