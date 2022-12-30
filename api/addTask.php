<?php
include_once './config/database.php';
require "../vendor/autoload.php";
use \Firebase\JWT\JWT;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$secret_key = "mytechuplabassignment";
$jwt = null;

$subject = '';
$description = '';
$start_date = '';
$due_date = '';
$status = '';
$priority = '';
$conn = null;

$noteText = '';
$noteText = '';
$noteAttchment = '';
$nattachment = '';

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

        
        /* ############# Start Code for adding Task API ################ */
        /*echo '<pre>';
        print_r($data);
        echo '</pre>';
        */

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

            $notes = $data->notes;
            $taskid = $conn->lastInsertId();
            //$taskid = 1;
            //print_r($notes);
            //print_r($taskid);
            if(isset($notes) && !empty($notes)) {
                foreach ($notes as $note) {
                    $noteSubject = $note->subject;
                    $noteAttchment = $note->attachments;
                    if(!empty($noteAttchment)) {
                        $nattachment = serialize($noteAttchment);
                    }

                    $noteText = $note->note;

                    $table_name1 = 'notes';

                    $query1 = "INSERT INTO " . $table_name1 . "
                                    SET task_id = :task_id,
                                        subject = :subject,
                                        attachment = :attachment,
                                        note = :note";

                    $stmt1 = $conn->prepare($query1);

                    $stmt1->bindParam(':task_id', $taskid);
                    $stmt1->bindParam(':subject', $noteSubject);
                    $stmt1->bindParam(':attachment', $nattachment);
                    $stmt1->bindParam(':note', $noteText);

                    $stmt1->execute();

                }
            }

            http_response_code(200);
            echo json_encode(array("message" => "Task created successfully."));
        }
        else{
            http_response_code(400);
            echo json_encode(array("message" => "Unable to create the task."));
        }

        /* ############# End Code for adding Task API ################ */

 
    }catch (Exception $e){
 
    http_response_code(401);
 
    echo json_encode(array(
        "message" => "Access denied.",
        //"error" => $e->getMessage()
    ));
}
 
}
?>