<?php
//fetch.php
//include'db_connect.php';
$conn=mysqli_connect("localhost","root","","css_db");

$column = array("tickets.id", "tickets.uniquid", "tickets.date_created", "tickets.customer_id", "tickets.subject", "tickets.lab", "tickets.Problem","departments.name", "tickets.status");
$query = "
 SELECT * FROM tickets 
 INNER JOIN departments 
 ON departments.id = tickets.department_id 
";

$query .= " WHERE ";
if (isset($_POST["is_category"])) {
    $query .= "tickets.department_id = '" . $_POST["is_category"] . "' AND ";
}

if (isset($_POST["search"]["value"])) {
    $query .= '(tickets.id LIKE "%' . $_POST["search"]["value"] . '%" )';
    $query .= 'OR tickets.uniqid LIKE "%' . $_POST["search"]["value"] . '%" ';
    // $query .= 'OR tickets.date_created LIKE "%' . $_POST["search"]["value"] . '%" ';
    // $query .= 'OR tickets.customer_id LIKE "%' . $_POST["search"]["value"] . '%" ';
    // $query .= 'OR tickets.subject LIKE "%' . $_POST["search"]["value"] . '%" ';
    // $query .= 'OR tickets.lab LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR tickets.Problem LIKE "%' . $_POST["search"]["value"] . '%" ';
    $query .= 'OR tickets.status LIKE "%' . $_POST["search"]["value"] . '%" )';
}

if (isset($_POST["order"])) {
    $query .= 'ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
} else {
    $query .= 'ORDER BY tickets.id DESC ';
}

$query1 = '';

if ($_POST["length"] != 1) {
     $query1 .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($conn, $query));

$result = mysqli_query($conn, $query);

$data = array();


while ($row = mysqli_fetch_array($result)) {
    $sub_array = array();
    $sub_array[] = $row["id"];
    $sub_array[] = $row["uniquid"];
    $sub_array[] = $row["date_created"];
    $sub_array[] = $row["customer_id"];
    $sub_array[] = $row["subject"];
    $sub_array[] = $row["lab"];
    $sub_array[] = $row["Problem"];
    $sub_array[] = $row["name"];
    $sub_array[] = $row["status"];
    $data[] = $sub_array;
}

function get_all_data($conn)
{
    $query = "SELECT * FROM tickets";
    $result = mysqli_query($conn, $query);
    return mysqli_num_rows($result);
}

$output = array(
    "draw"    => intval($_POST["draw"]),
    "recordsTotal"  =>  get_all_data($conn),
    "recordsFiltered" => $number_filter_row,
    "data"    => $data
);

echo json_encode($output);