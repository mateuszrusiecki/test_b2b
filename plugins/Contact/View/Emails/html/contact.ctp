<p>Witamy!</p>

<p>Za pośrednictwem serwisu <a href="http://autopart.pl/">AUTOPART.pl</a>, 
    przy pomocy formularza przesłano zapytanie. </p>

<p>Dane nadawcy:</p>
<?php if(!empty($data['FormContact']['companyName'])) {
    echo '<p><strong>Firma: '.  $data['FormContact']['companyName']. '</p>'; 
} ?>
<p><strong>Osoba kontaktowa: </strong> <?php echo $data['FormContact']['person']; ?> </p>
<?php if(!empty($data['FormContact']['address'])) {
    echo '<p><strong>Adres: '.  $data['FormContact']['address']. '</p>'; 
} 
if(!empty($data['FormContact']['phone'])) {
    echo '<p><strong>Telefon: '.  $data['FormContact']['phone']. '</p>'; 
}
?>

<h3>Szczegóły zapytania:</h3>

<p><?php echo '<strong>E-mail: </strong>' . $data['FormContact']['email']; ?></p>

<p><?php echo '<strong>Treść: </strong><br />' . nl2br($data['FormContact']['content']); ?></p>