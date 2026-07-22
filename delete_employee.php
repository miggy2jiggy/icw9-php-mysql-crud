<?php
require 'db.php';

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    die("Invalid employee ID.");
}

$emp_id = (int) $_GET["id"];

$stmt = $conn->prepare(
    "DELETE FROM employees
     WHERE emp_id = ?"
);

$stmt->bind_param("i", $emp_id);

if ($stmt->execute()) {
    $stmt->close();
    $conn->close();

    header("Location: index.php");
    exit;
}

$stmt->close();
$conn->close();

die("Employee could not be deleted.");
?>