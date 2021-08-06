<?php		
	$keyword = strval($_POST['query']);
	$search_param = "{$keyword}%";
	$conn =new mysqli('localhost', 'root', '' , 'emr');

	$sql = $conn->prepare("SELECT * FROM products WHERE name LIKE ?");
	$sql->bind_param("s",$search_param);			
	$sql->execute();
	$result = $sql->get_result();
	$productResult = array();
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
		$productResult[] = $row["name"];
		}
		echo json_encode($productResult);
	}
	$conn->close();


