<?php
$apiKey = '70e1fcb24d9cf905714f0cb390e8861a';
$language = 'it-IT';
$url = "https://api.themoviedb.org/3/genre/movie/list?api_key=$apiKey&language=$language";

$response = file_get_contents($url);
$responseData = json_decode($response, true);

if($responseData === null || !isset($responseData['genres'])) {
    // Gestisci l'errore nella decodifica JSON o struttura non valida
    echo "Errore nella decodifica JSON o struttura non valida.";
} else {
    // Crea un array associativo di id-genere
    $genreList = array_column($responseData['genres'], 'name');

    // Filtra gli id dei generi desiderati
    $selectedGenres = [1, 2, 3]; // Sostituisci con i tuoi id di genere desiderati
    $filteredGenres = array_intersect($selectedGenres, array_column($responseData['genres'], 'id'));

    // Genera la stringa di output
    $outString = implode(' | ', array_intersect_key($genreList, array_flip($filteredGenres)));

    echo $outString;
}
?>