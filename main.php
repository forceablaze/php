<?php

require_once ("./SubProcess.php");

$handlers = array(
	0 => function($pipes) {
		if(empty($pipes)) {
			echo "execute failed". PHP_EOL;
        } else {
            while(!feof($pipes[1])) {
			    echo stream_get_contents($pipes[1]);
            }
        }
	},
	1 => function($ret) {
		echo "return value:". $ret. PHP_EOL;
	}
);

SubProcess::execAsync("ls", array("-al", "/"), $res, $handlers, null);
//SubProcess::execAsync("./loop.sh", null, $res, $handlers, null);
exec("./loop.sh");
print_r($res);
echo "waitting" . PHP_EOL;
SubProcess::waitAllSubProcess();
?>
