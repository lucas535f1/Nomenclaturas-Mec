<?php
$result = $_POST['ue'];
$result_explode = explode('|', $result);
$return= $result_explode[1];
echo json_encode($return);

