<style type="text/css">
    .tc{
        text-align: center;
    }
    .fr{
        float: right;
    }
    .clear{
        clear: both;
    }
    table td{
        border: thin solid #000;
        padding:1mm 5mm;
    }

</style>

<div style="font-size:65%">

	<span><span style="font-size: 160%"><?php echo (isset($profile)) ? $profile['company_name'] : '...................................' ?></span>
		<br/>
		<small>(nazwa pracodawcy (pieczątka))</small></span>

	<h3 class="tc"><span>KARTA SZKOLENIA WSTĘPNEGO</span><br>
		<span>W DZIEDZINIE BEZPIECZEŃSTWA I HIGIENY PRACY</span></h3>
	<table>
		<tr>
			<td colspan="2">
				<p>
					<span>1. Imię i nazwisko osoby odbywającej szkolenie
						
						<strong style="margin-left:50px;font-size: 120%">
							<?php
							echo (isset($profile)) ? $profile['firstname'] . ' ' . $profile['surname'] : '';
							?>
						</strong>
						<?php
						if (isset($profile)) {
							//
						} else
							echo '....................................................................................................................';
						?>
						<br/>
					</span>
				</p>
				<p><span></span></p>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<p>
					<span>2. Nazwa komórki organizacyjnej</span>
					..................................................................................................................
				</p>
			</td>
		</tr>
		<tr>
			<td>
				3. Instruktaż ogólny<br>
				
			</td>
			<td>
				<p><span>Instruktaż ogólny przeprowadził w dniu</span>
					...........................................
                </p>
				<br/>
				<p class="fr tc">
					..................................................................<br>
					<small>(podpis osoby, której udzielono instruktażu*)</small>
				</p>
				<p>
					r. ....................................................................<br>
					<small>(imię i nazwisko przeprowadzającego instruktaż)</small>
				</p>
				<br>
			</td>
		</tr>
		<tr>
			<td rowspan="2">4.Instruktaż stanowiskowy</td>
			<td>
				<p><span>1) Instruktaż stanowiskowy na stanowisku pracy</span></p>
				<p><span>przeprowadziá w dniach .................................................</span></p>

				<p><span>r. ..............................................................................<br/>(imię i nazwisko przeprowadzającego instruktaż)</span></p>
				<p><span>Po przeprowadzeniu sprawdzianu wiadomości i umiejętności z zakresu wykonywania pracy</span></p>
				<p><span>zgodnie z przepisami i zasadami bezpieczeństwa i higieny pracy Pan(i)</span></p>
				<p><span><span style="position: absolute;font-weight: bold"></span><?php if (isset($profile)) echo $profile['firstname'] . ' ' . $profile['surname'] ?>...............................</span><span>  zostaá(a) dopuszczony(a) do wykonywania pracy na</span></p>
				<p><span>stanowisku ......................................................</span></p>

				<br/>
				<p class="fr tc">
					..................................................................<br>
					<small>(podpis osoby, której udzielono instruktażu*)</small>
				</p>
				<p>
					r. ....................................................................<br>
					<small>(data i podpis kierownika komórki organizacyjnej)</small>
				</p>
				<br/>

			</td>
		</tr>
		<tr>
			<td> 
				<p><span>2)** Instruktaż stanowiskowy na stanowisku pracy przeprowadziá w dniach</span></p>
			
				<p><span>r. ................................................................................</span></p>
				<p><span>(imię i nazwisko przeprowadzającego instruktaż)</span></p>
				<p><span>Po przeprowadzeniu sprawdzianu wiadomości i umiejętności z zakresu wykonywania pracy</span></p>
				<p><span>zgodnie z przepisami i zasadami bezpieczeństwa i higieny pracy Pan(i)</span></p>
				<p><span>...............................</span><span>  zostaá(a) dopuszczony(a) do wykonywania pracy na</span></p>
				<p><span>stanowisku .........................................................</span></p>

				<br/>
				<p class="fr tc">
					..................................................................<br>
					<small>(podpis osoby, której udzielono instruktażu*)</small>
				</p>
				<p>
					r. ....................................................................<br>
					<small>(data i podpis kierownika komórki organizacyjnej)</small>
				</p>
				<br/>
			</td>
		</tr>
	</table>
	<p><span>*   Podpis stanowi potwierdzenie odbycia instruktażu i zapoznania się z przepisami oraz zasadami bezpieczeństwa</span></p>
	<p><span>i higieny pracy dotyczącymi wykonywanych prac.</span></p>
	<p><span>** Wypełniać w przypadkach, o których mowa w § 11 ust. 1 pkt 2 i ust. 2 i 3 rozporządzenia Ministra Gospodarki</span></p>
	<p><span>i Pracy z dnia 27 lipca 2004 r. w sprawie szkolenia w dziedzinie bezpieczeństwa i higieny pracy.</span></p>
</div>