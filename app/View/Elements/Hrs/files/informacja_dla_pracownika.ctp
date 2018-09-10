<style type="text/css">
    body{
        font-family: sans-serif;
        font-size: large;
    }
    .fr{
        float: right;
    }
    .big{
        font-size: 5mm;
        font-weight: semibold;

    }
    .tc{
        text-align: center;
    }
    .tr{
        text-align: right
    }
    .clear{
        clear: both;
    }
</style>
<p  class="fr tc">
    <b class="big"></b><br>
    ......................................................<br>
    <small><?php echo __d('public', 'miejscowość, data') ?></small>
</p>
<p> <?php if (isset($profile)) echo $profile['company_name'] ?><br/>
    ....................................................</p> 

<p> <?php if (isset($profile)) echo $profile['company_address'] ?><br/>
    ....................................................</p> 

<p> <?php if (isset($profile)) echo $profile['company_address2'] ?><br/>
    ....................................................<br>

    <small>(<?php echo __d('public', 'nazwa firmy, adres') ?>)</small>
</p>

<p>&nbsp;</p>


<h1 class="tc"><strong><?php echo __d('public', 'Informacja dla pracownika') ?></strong></h1>

<br class="clear">
<p class="fr tc"> <b class="big"><?php echo (isset($profile)) ? $profile['firstname'] . '  ' . $profile['surname'] : ''; ?></b>
   <?php echo (empty($profile))?' ......................................................':''; ?>
    <br>
    <?php echo __d('public', 'imię i nazwisko pracownika') ?></p>
<br class="clear">


<p>Na podstawie art. 29 par.3 k.p. informuję:</p>

<p>&nbsp;</p>

<ol>
    <li>Obowiązują następujące normy czasu pracy:
        <ol style="list-style: lower-alpha;">
            <li>8 godzin na dobę</li>
            <li>przeciętnie 40 godzin w przeciętnie pięciodniowym tygodniu pracy w jednomiesięcznym okresie rozliczeniowym.</li>
        </ol>
    </li>
    <li>
        Prawo do urlopu nabywa Pan/i wg następujących zasad:
        <ol style="list-style: lower-alpha;">
            <li>Pracownik podejmujący pracę po raz pierwszy, w roku kalendarzowym, wkt&oacute;rym podjął pracę, uzyskuje prawo do urlopu z upływem każdego miesiąca pracy, w wymiarze 1/12 wymiaru urlopu przysługującego mu po przepracowaniu roku</li>
            <li>prawo do kolejnych urlop&oacute;w pracownik nabywa w każdym kolejnym roku kalendarzowym</li>
            <li>wymiar urlopu wynosi: 20 dni- jeżeli pracownik jest zatrudniony kr&oacute;cej niż 10 lat, 26 dni- jeżeli pracownik jest zatrudniony co najmniej 10 lat</li>
            <li>do okresu pracy, od kt&oacute;rego zależy wymiar urlopu, wlicza się odpowiednią, określoną w Kodeksie Pracy, ilość lat z tytułu ukończenia szkoły.</li>
        </ol>

    </li>
    <li>

        Okres wypowiedzenia umowy o pracę:

        <ol style="list-style: lower-alpha;">
            <li>
                <p>zawartej na czas nieokreślony jest uzależniony od okresu zatrudnienia udanego pracodawcy i wynosi:</p>

                <p>- 2 tygodnie, jeżeli pracownik był zatrudniony kr&oacute;cej niż 6 miesięcy,</p>

                <p>- 1 miesiąc, jeżeli pracownik był zatrudniony co najmniej 6 miesięcy</p>

                <p>- 3 miesiące, jeżeli pracownik był zatrudniony co najmniej 3 lata.</p>

            </li>

            <li>
                <p>zawartej na czas określony, dłuższy niż 6 miesięcy wynosi 2 tygodnie.</p>

            </li>
            <li>
                <p>zawartej na okres pr&oacute;bny wynosi:</p>

                <p>- 3 dni robocze, jeśli okres pr&oacute;bny nie przekracza 2 tygodni,</p>

                <p>- 1 tydzień, jeżeli okres pr&oacute;bny jest dłuższy niż 2 tygodnie,</p>

                <p>- 2 tygodnie jeżeli okres pr&oacute;bny wynosi 3 miesiące.</p>
            </li>
        </ol>
    </li>
    <li>
        Pora nocna obejmuje 8 godzin pomiędzy godzinami 22:00 a 6:00.
    
    </li>

    <li>
        Wynagrodzenie za pracę jest przekazywane do 10. każdego następnego miesiąca na wskazany przez pracownika rachunek bankowy.
     
    </li>

    <li>
        Przyjście i obecność pracownika są potwierdzane przez podpisanie listy obecności w pracy, znajdującej się w miejscu pracy.
      
    </li>

    <li>
        Obowiązujące godziny pracy : 8:00 &ndash; 16:00.
    
    </li>

    <li>
        O każdorazowej nieobecności w pracy i długości jej trwania, pracownik jest zobowiązany niezwłocznie zawiadomić pracodawcę osobiście, telefonicznie lub za pośrednictwem innej osoby.
     
    </li>

    <li>
        Soboty są dniami wolnymi.
    </li>
</ol>


<p>&nbsp;</p>

<p>&nbsp;</p>


<p>&nbsp;</p>

<p class="fr tc"> <br/><br/>............................................................<br>
    <small>
        Podpis pracodawcy
    </small> 
</p>






<p>Informację otrzymałem/łam</p>

<p>&nbsp;</p>

<p>..................................................................<br>
    <small>(podpis pracownika)</small>
</p>