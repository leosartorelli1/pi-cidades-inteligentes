<?php
require '../connection.php';

if (isset($_GET['id'])) {
    $id = new MongoDB\BSON\ObjectId($_GET['id']);

    // Preparar a exclusão
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->delete(['_id' => $id]);

    // Executar a exclusão
    $manager->executeBulkWrite('empresa.veiculos_cadastrados', $bulk);

<<<<<<< HEAD
=======
<<<<<<< HEAD
    echo "Veiculo deletado com sucesso!";
}
=======
>>>>>>> e0c1cacc24072453bfd7a7f7223996038cffcc97
    header('Location: index.php');
}
    
exit;
<<<<<<< HEAD
=======
>>>>>>> 7896834 (Front-End)
>>>>>>> e0c1cacc24072453bfd7a7f7223996038cffcc97
?>