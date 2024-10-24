<?php  

function insertIntoRecords($pdo, $firstname, $lastname, 
$carmanufacturer, $dateofrental, $carmodel, $expectedreturn) {

	$sql = "INSERT INTO car_rental (first_name, last_name, 
		car_manufacturer, date_of_rental, car_model, expected_return) VALUES(?,?,?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$firstname, $lastname, 
		$carmanufacturer, $dateofrental, $carmodel, $expectedreturn]);

	if ($executeQuery) {
		return true;
	}
}



function updateWebDev($pdo, $firstname, $lastname, 
$carmanufacturer, $dateofrental, $carmodel, $expectedreturn, $rental_id) {

	$sql = "UPDATE car_rental
				SET first_name = ?,
					last_name = ?,
					car_manufacturer = ?, 
					date_of_rental = ?,
					car_model = ?,
					expected_return = ?
				WHERE rental_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$firstname, $lastname, 
	$carmanufacturer, $dateofrental, $carmodel, $expectedreturn, $rental_id]);
	
	if ($executeQuery) {
		return true;
	}

}


function deleteWebDev($pdo, $rental_id) {
	$deleteWebDevProj = "DELETE FROM car_rental WHERE rental_id = ?";
	$deleteStmt = $pdo->prepare($deleteWebDevProj);
	$executeDeleteQuery = $deleteStmt->execute([$rental_id]);

	if ($executeDeleteQuery) {
		$sql = "DELETE FROM car_rental WHERE rental_id = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$rental_id]);

		if ($executeQuery) {
			return true;
		}

	}
	
}




function getAllWebDevs($pdo) {
	$sql = "SELECT * FROM car_rental";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getWebDevByID($pdo, $rental_id) {
	$sql = "SELECT * FROM car_rental WHERE rental_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$rental_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}



function getProjectsByWebDev($pdo, $rental_id) {
    $sql = "SELECT 
                clients.client_id AS client_id,
                clients.client_first_name AS firstname,
                clients.client_last_name AS lastname,
                CONCAT(car_rental.car_manufacturer, ' ', car_rental.car_model) AS car_rented,
                clients.date_added AS date_added
            FROM clients
            JOIN car_rental ON clients.rental_id = car_rental.rental_id
            WHERE car_rental.rental_id = ? 
            GROUP BY clients.client_id;";
    
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$rental_id]);
    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}



function insertProject($pdo, $firstname, $lastname, $rental_id) {
    $sql = "INSERT INTO clients (client_first_name, client_last_name, rental_id, date_added) VALUES (?,?,?, CURDATE())";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$firstname, $lastname, $rental_id]);
    
    if ($executeQuery) {
        return true;
    }
    return false;
}



function getProjectByID($pdo, $client_id) {
    $sql = "SELECT 
                clients.client_id AS client_id,
                clients.client_first_name AS firstname,
                clients.client_last_name AS lastname,
                CONCAT(car_rental.car_manufacturer,' ',car_rental.car_model) AS car_rented,
                clients.date_added AS date_added
            FROM clients
            JOIN car_rental ON clients.rental_id = car_rental.rental_id
            WHERE clients.client_id = ?
			GROUP BY clients.client_id;";


    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$client_id]);
    if ($executeQuery) {
        return $stmt->fetch();
    }
}


function updateProject($pdo, $client_first_name, $client_last_name, $client_id) {
	$sql = "UPDATE clients
			SET client_first_name = ?,
				client_last_name = ?
			WHERE client_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$client_first_name, $client_last_name, $client_id]);

	if ($executeQuery) {
		return true;
	}
}

function deleteProject($pdo, $client_id) {
	$sql = "DELETE FROM clients WHERE client_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$client_id]);
	if ($executeQuery) {
		return true;
	}
}

function getAllInfoByWebDevID($pdo, $rental_id ) {
	$sql = "SELECT * FROM car_rental WHERE rental_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$rental_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}



?>