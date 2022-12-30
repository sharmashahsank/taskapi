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
//$email = "sharmashashank810@gmail.com";

$priorityarr = array('Low', 'Medium', 'High');
$statusarr = array('Incomplete', 'Complete', 'New');

if($jwt){
 
    try {
        //var_dump($jwt);
        $decoded = JWT::decode($jwt, $secret_key, array('HS256'));

        
        /* ############# Start Code for fetching Task ################ */
        $table_name = 'tasks';

        $query = "SELECT t.id,t.subject,t.status,t.priority,COUNT(n.task_id) as notecount FROM tasks as t INNER JOIN notes as n ON n.task_id = t.id GROUP BY n.task_id ORDER BY t.priority DESC, notecount DESC";

        $stmt = $conn->prepare( $query );
        //$stmt->bindParam(1, $email);
        $stmt->execute();
        $num = $stmt->rowCount();

        if($num > 0){
            $taskarr = array();
            $i=0;
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { 
                //echo 'LINE54= '.$id = $row['id'];
                $taskarr[$i]['taskid'] = $row['id'];
                $taskarr[$i]['subject'] = $row['subject'];
                $taskarr[$i]['priority'] = $priorityarr[$row['priority']];
                $taskarr[$i]['status'] = $statusarr[$row['status']];


                $query_notes = "SELECT * FROM notes WHERE task_id = ".$row['id'];

                $stmt_notes = $conn->prepare( $query_notes );
                //$stmt->bindParam(1, $email);
                $stmt_notes->execute();
                $notenum = $stmt_notes->rowCount();

                if($notenum > 0){
                    $k=0;
                    while ($rownotes = $stmt_notes->fetch(PDO::FETCH_ASSOC)) { 
                        
                        $taskarr[$i]['notes'][$rownotes['task_id']][$k]['subject'] = $rownotes['subject'];
                        $taskarr[$i]['notes'][$rownotes['task_id']][$k]['attachment'] = unserialize($rownotes['attachment']);
                        $taskarr[$i]['notes'][$rownotes['task_id']][$k]['note'] = $rownotes['note'];
                        $k++;
                    }
                }


                $i++;
            }

            http_response_code(200);
            echo json_encode($taskarr);

            /*
            echo '<pre>';
            print_r($taskarr);
            echo '</pre>';
            */
        }
 
    }catch (Exception $e){
 
    http_response_code(401);
 
    echo json_encode(array(
        "message" => "Access denied.",
        //"error" => $e->getMessage()
    ));
}
 
}
?>