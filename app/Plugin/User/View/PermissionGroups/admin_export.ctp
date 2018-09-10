<?php
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=data.json');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . strlen($json_data));
    ob_clean();
    flush();
    echo $json_data;
    
    Configure::write('debug', 0);
//echo $content_for_layout;
?>