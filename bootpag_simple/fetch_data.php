<?php
include_once("db_connect.php");

if (isset($_POST["page"])) {
    $page_no = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
    if(!is_numeric($page_no))
        die("Error fetching data! Invalid page number!!!");
} else {
    $page_no = 1;
}

// get record starting position
$start = (($page_no-1) * $row_limit);

$results = $pdo->prepare("SELECT * FROM customers ORDER BY id LIMIT $start, $row_limit");
$results->execute();

while($row = $results->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>" . 
    "<td>" . $row['id'] . "</td>" . 
    "<td>" . $row['name'] . "</td>" . 
    "<td>" . $row['email'] . "</td>" . 
    "<td>" . $row['city'] . "</td>" . 
    "</tr>";
}
?>
