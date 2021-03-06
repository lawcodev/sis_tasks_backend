
<?php
  function API_GetTaskByFinishDate() {
    require_once 'Core/Task/TaskFunctions.php';
    require_once 'Config/config.php';

    $json_success_data = array();
    if(empty($_GET['id']) || !isset($_GET['id'])) {
      $json_error_data = array(
        'api_status' => 400,
        'api_text' => 'failed',
        'api_version' => $api_version,
        'api_copyright' => $api_copyright,
        'errors' => array(
          'error_id' => '1',
          'error_text' => 'Peticion invalida, parametro no especificado.'
        )
      );
      header("Content-type: application/json");
      echo json_encode($json_error_data, JSON_PRETTY_PRINT);
      exit();
    } else {
      if($_GET['action'] == 'task') {
        $finish_date = $_GET['id'];
        if($_GET['action'] == 'task') {
          $year = substr($finish_date, 0, 4); 
          $month = substr($finish_date, 4, 6);
          $finish_date = $year . '-' . $month . '%';
          $controller = TaskCore::CreateControllerTask();
          $tasks = $controller->GetAllTasks(2, $finish_date);
          $json_success_data = array(
            'api_status' => 200,
            'api_text' => 'success',
            'api_version' => $api_version,
            'api_copyright' => $api_copyright,
            'tasks' => $tasks
          );    
          header("Content-type: application/json");
          echo json_encode($json_success_data, JSON_PRETTY_PRINT);
          exit();
        }
      }
    }
  }
?>