<?php

$db = mysqli_connect("localhost", "root", "", "test");

if (isset($_POST["surname"]))
{
    insert();
}

if (isset($_GET['info']))
{
    get();
}
function insert()
{
    global $db;
    extract($_POST);
    $sql = $db->query("INSERT INTO student (surname,firstname,othername,gender,school,class,phone,address,state,lga) VALUES ('$surname','$firstname','$othername','$gender','$school','$class','$phone','$address','$state','$lga')") or die($db->error);

    $id = $db->insert_id;
    $output = array('id' => $id, 'surname' => $surname, 'firstname' => $firstname, 'othername' => $othername, 'gender' => $gender, 'school' => $school, 'class' => $class);
    echo json_encode($output);
    return;

}

function get()
{
    global $db;
    extract($_GET);

    $sql = $db->query("SELECT * FROM student WHERE id = '$info' ");

    $row = $sql->fetch_assoc();

    echo json_encode($row);
    return;

}

function table()
{
    global $db;
    extract($_GET);
    $output = '';

    $sql = $db->query("SELECT * FROM student WHERE id = '$info' ");

    $row = $sql->fetch_assoc();

    while ($row = $sql->fetch_object())
    {
        $output .= '
                <tr id=' . $row->id . '>
                    <td>' . $row->surname . '</td>
                    <td>' . $row->firstname . '</td>
                    <td>' . $row->othername . '</td>
                    <td>' . $row->gender . '</td>
                    <td>' . $row->school . '</td>
                    <td>' . $row->class . '</td>
                    <td>' + '<button class="btn btn-primary detailsbtn">Details</button>' + '</td>
                </tr>';
    }
    echo $output;
    return;
}