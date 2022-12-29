<?php
include_once './config/database.php';
require "../vendor/autoload.php";
use \Firebase\JWT\JWT;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


//$secret_key = "YOUR_SECRET_KEY";
$secret_key = "mytechuplabassignment";
$jwt = null;

$subject = '';
$description = '';
$start_date = '';
$due_date = '';
$status = '';
$priority = '';
$conn = null;

$databaseService = new DatabaseService();
$conn = $databaseService->getConnection();

$data = json_decode(file_get_contents("php://input"));


$authHeader = $_SERVER['HTTP_AUTHORIZATION'];

$arr = explode(" ", $authHeader);

//print_r($arr); die();

/*echo json_encode(array(
    "message" => "sd" .$arr[1]
));*/

$jwt = $arr[1];

if($jwt){
 
    try {
        //var_dump($jwt);
        $decoded = JWT::decode($jwt, $secret_key, array('HS256'));

        
        /* ############# Code for adding Task API ################ */
        echo '<pre>';
        print_r($data);
        echo '</pre>';


        $subject = $data->subject;
        $description = $data->description;
        $start_date = $data->start_date;
        $due_date = $data->due_date;
        $status = $data->status;
        $priority = $data->priority;

        $table_name = 'tasks';

        $query = "INSERT INTO " . $table_name . "
                        SET subject = :subject,
                            description = :description,
                            start_date = :start_date,
                            due_date = :due_date,
                            status = :status,
                            priority = :priority";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':start_date', $start_date);
        $stmt->bindParam(':due_date', $due_date);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':priority', $priority);


        if($stmt->execute()){
         
            http_response_code(200);
            echo json_encode(array("message" => "User was successfully registered."));
        }
        else{
            http_response_code(400);
         
            echo json_encode(array("message" => "Unable to register the user."));
        }



        /*echo json_encode(array(
            "message" => "Access granted: ".$jwt,
            //"error" => $e->getMessage()
        ));*/
 
    }catch (Exception $e){
 
    http_response_code(401);
 
    echo json_encode(array(
        "message" => "Access denied.",
        //"error" => $e->getMessage()
    ));
}
 
}
?>