<?php
	shell_exec('dicom2.exe dicom2 -j -t test.dcm');

	echo '<img src="test.dcm.jpg" border="0" width="400" height="400" >';
?>
