<?php

class DownloadFilesComponent extends Component {
	
	
	
    function download($file, $src)
    {

		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.$file['file']);
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');
		header('Content-Length: ' . filesize('files/'.$src.'/' . $file['file']));
	
        readfile('files/'.$src.'/' . $file['file']);
		exit;
	}
	
}

