<?php
    header("Content-type: application/vnd.ms-word");
    header("Content-Disposition: attachment;Filename=" . $documentTitle . ".doc");    
?>

<?php echo $documentContent; ?>
