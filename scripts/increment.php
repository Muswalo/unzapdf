<?php
require_once('db_connection.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "UPDATE pdfs SET recommendation = recommendation + 1 WHERE id = ?";
    
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        if (mysqli_stmt_execute($stmt)) {
            $sql_select = "SELECT recommendation FROM pdfs WHERE id = ?";
            $stmt_select = mysqli_prepare($conn, $sql_select);
            mysqli_stmt_bind_param($stmt_select, "i", $id);
            mysqli_stmt_execute($stmt_select);
            mysqli_stmt_bind_result($stmt_select, $updatedValue);
            mysqli_stmt_fetch($stmt_select);
            
            header('Content-Type: application/json');
            echo json_encode(array('updatedValue' => $updatedValue));
        } else {
            http_response_code(500);
            echo json_encode(array('error' => 'Failed to update recommendation value'));
        }
        
        mysqli_stmt_close($stmt);
    } else {
        http_response_code(500);
        echo json_encode(array('error' => 'Failed to prepare statement'));
    }
} else {
    http_response_code(400);
    echo json_encode(array('error' => 'ID parameter is missing'));
}
mysqli_close($conn);
?>
