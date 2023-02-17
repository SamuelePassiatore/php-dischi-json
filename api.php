<?php

//! SQL FILE
// Preparo le informazioni di connessione
const DB_SERVERNAME = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = 'root';
const DB_NAME = 'discs';

$discs = [];

try {
    $conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}

try {
    $sql = 'SELECT * FROM `albums`';
    $result = $conn->query($sql);

    if ($result->num_rows) {
        while ($row = $result->fetch_assoc()) {
            array_push($discs, $row);
        }
    } else {
        echo 'Spiacente';
    }
} catch (Exception $e) {
    echo $e->getMessage();
    die();
}

$conn->close();


//! JSON FILE

// // Recover json file 
// $source_path = __DIR__ . './data.json';

// // Read content file
// $json_data = file_get_contents($source_path);


// Take choice user in select for genre filter
$genre = $_GET['genre'] ?? '';
$filtered_discs = [];
foreach ($discs as $disc) {
    if ($genre === '' || $disc['genre'] === $genre) {
        $filtered_discs[] = $disc;
    }
}

//  Tell to server I want to write in json
header('Content-Type: application/json');

//  Convert to json and return discs
echo json_encode($filtered_discs);
