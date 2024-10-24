<?php 

require_once 'core.php'; 
require_once 'models.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "Form is submitted via POST";
} else {
    echo "Form is NOT submitted via POST";
}


if (isset($_POST['Btninsert'])) {
	$firstname = trim($_POST['firstname']);
	$lastname = trim($_POST['lastname']);
	$carmanufacturer = trim($_POST['carmanufacturer']);
	$dateofrental = trim($_POST['dateofrental']);
	$carmodel = trim($_POST['carmodel']);
	$expectedreturn = trim($_POST['expectedreturn']);

	if (!empty($firstname) && !empty($lastname) && !empty($carmanufacturer) && !empty($dateofrental) && !empty($carmodel)   && !empty($expectedreturn)) {
			$query = insertIntoRecords($pdo, $firstname, $lastname, $carmanufacturer, $dateofrental, $carmodel, $expectedreturn);

		if ($query) {
			header('Location: sqsample.php');
        exit();
		}

		else {
			echo "Insertion failed";
		}
	}

	else {
		echo "Make sure that no fields are empty";
	}
	
}

if (isset($_POST['editWebDevBtn'])) {
	$query = updateWebDev($pdo, $_POST['firstname'], $_POST['lastname'], 
		$_POST['carmanufacturer'], $_POST['dateofrental'], $_POST['carmodel'], $_POST['expectedreturn'], $_GET['rental_id']);

	if ($query) {
		header("Location: sqsample.php");
	}

	else {
		echo "Edit failed";;
	}

}

if (isset($_POST['deleteWebDevBtn'])) {
	$query = deleteWebDev($pdo, $_GET['rental_id']);

	if ($query) {
		header("Location: sqsample.php");
	}

	else {
		echo "Deletion failed";
	}
}

if (isset($_POST['insertNewProjectBtn'])) {
    $firstname = trim($_POST['first_name']);
    $lastname = trim($_POST['last_name']);

    if (!empty($firstname) && !empty($lastname)) {
        $query = insertProject($pdo, $firstname, $lastname, $_GET['rental_id']);
        if ($query) {
            header('Location: viewprojects.php?rental_id=' . $_GET['rental_id']);
            exit();
        } else {
            echo "Insertion failed";
        }
    } else {
        echo "Please fill in all fields.";
    }
}


if (isset($_POST['editProjectBtn'])) {
	$query = updateProject($pdo, $_POST['firstname'], $_POST['lastname'], $_GET['client_id']);

	if ($query) {
		header("Location: viewprojects.php?rental_id=" .$_GET['rental_id']);
	}
	else {
		echo "Update failed";
	}

}

if (isset($_POST['deleteProjectBtn'])) {
	$query = deleteProject($pdo, $_GET['client_id']);

	if ($query) {
		header("Location: viewprojects.php?rental_id=" .$_GET['rental_id']);
	}
	else {
		echo "Deletion failed";
	}
}
 


?>