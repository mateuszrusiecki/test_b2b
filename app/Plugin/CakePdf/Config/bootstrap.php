<?php

App::build(array('Pdf' => array('%s' . 'Pdf' . DS)), App::REGISTER);
App::build(array('Pdf/Engine' => array('%s' . 'Pdf/Engine' . DS)), App::REGISTER);
App::uses('PdfView', 'CakePdf.View');


/*
 * TODO
 * 
 * Zmienić ustawienia przy zmianiewersji serwera
 */
//Configure::write('CakePdf.binary', 'C:\wkhtmltopdf\bin\wkhtmltopdf.exe');
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
{
    $server = APP . 'Plugin\CakePdf\Vendor\wkhtmltopdf\wkhtmltopdf.exe';
} else
{
    //$server = '/usr/bin/wkhtmltopdf.sh';
    $server = '/usr/local/bin/wkhtmltopdf';
    // na produkcyjnym ma byc tak!
    //$server = '/usr/bin/xvfb-run   --server-args="-screen 0, 1024x768x24"   /usr/bin/wkhtmltopdf';
}
Configure::write('CakePdf', array(
    'engine' => 'CakePdf.WkHtmlToPdf',
    'pageSize' => 'A4',
    'orientation' => 'portrait',
    'download' => false,
    'binary' => $server
));
