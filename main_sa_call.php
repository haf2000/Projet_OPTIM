<?php 

// $command = escapeshellcmd('main_sa.py');
// $output = shell_exec($command);
// echo $output;
$result= exec("main_sa.py");
echo "done";
?>