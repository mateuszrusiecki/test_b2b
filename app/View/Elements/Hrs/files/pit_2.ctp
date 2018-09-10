
<style type="text/css">
    .tc{
        text-align: center
    }
    .tr{
        text-align: right;
    }
    .fr{
        float: right;
    }
</style>
<div id="page_1" style="font-size: 90%">
	<div id="dimg1">
		<img id="img1" src="PIT-2_2014_images/PIT-2_20141x1.jpg">
	</div>


	<div id="id_1">
		<p class="p0 ft0">WYPEŁNIAĆ NA MASZYNIE, KOMPUTEROWO LUB RĘCZNIE, DUŻYMI, DRUKOWANYMI LITERAMI, CZARNYM LUB NIEBIESKIM KOLOREM.</p>
	</div>
	<div id="id_2">
		<div id="id_2_1">
			<p class="p0 ft2">1. Identyfikator podatkowy NIP / numer PESEL <span class="ft1">(niepotrzebne skreślić) </span>podatnika</p>
			<p class="p1 ft3">└────┴────┴────┴────┴────┴────┴────┴────┴────┴────┴────┘</p>
		</div>
		<div id="id_2_2">
			<p class="p0 ft4">Załącznik nr 1</p>
		</div>
	</div>
	<div id="id_3">
		<p class="p2 ft5"><nobr>PIT-2</nobr></p>
		<p class="p3 ft7"><span class="ft6">OŚWIADCZENIE </span>pracownika</p>
		<p class="p4 ft8">dla celów obliczania miesięcznych zaliczek na podatek dochodowy od osób fizycznych</p>
		<table cellspacing="0" cellpadding="0" class="t0">
			<tbody><tr>
					<td class="tr0 td0"></td>
					<td class="tr1 td1" rowspan="2" colspan="2"><p class="p5 ft9">Podstawa prawna:</p></td>
					<td class="tr1 td2" rowspan="2" colspan="3"><p class="p5 ft10">Art. 32 ust. 3 ustawy z dnia 26 lipca 1991 r. o podatku dochodowym od osób fizycznych (Dz. U. z 2012 r. poz. 361, z późn. zm.),</p></td>
				</tr>
				<tr>
					<td class="tr2 td0"></td>
				</tr>
				<tr>
					<td class="tr3 td0"></td>
					<td class="tr3 td3"><p class="p6 ft11">&nbsp;</p></td>
					<td class="tr3 td4"><p class="p6 ft11">&nbsp;</p></td>
					<td class="tr4 td5" rowspan="2" colspan="2"><p class="p5 ft9">zwanej dalej <span class="ft12">”</span>ustawą”.</p></td>
					<td class="tr3 td6"><p class="p6 ft11">&nbsp;</p></td>
				</tr>
				<tr>
					<td class="tr5 td0"></td>
					<td class="tr5 td7"><p class="p6 ft13">&nbsp;</p></td>
					<td class="tr5 td8"><p class="p6 ft13">&nbsp;</p></td>
					<td class="tr5 td9"><p class="p6 ft13">&nbsp;</p></td>
				</tr>
				<tr>
					<td class="tr6 td0"></td>
					<td class="tr6 td10" colspan="4"><p class="p5 ft14">A. DANE IDENTYFIKACYJNE PODATNIKA</p></td>
					<td class="tr6 td11"><p class="p6 ft15">&nbsp;</p></td>
				</tr>
				<tr>
					<td class="tr1 td0"></td>
					<td class="tr1 td12"><p class="p6 ft15">&nbsp;</p></td>
					<td class="tr1 td13"><p class="p7 ft2">2. Nazwisko <br/><span style="font-size:150%"><?php if (isset($profile)) echo $profile['surname'] ?></span></p></td>
					<td class="tr1 td14"><p class="p6 ft15">&nbsp;</p></td>
					<td class="tr1 td15"><p class="p5 ft2">3. Pierwsze imię <br/><span style="font-size:150%"><?php if (isset($profile)) echo $profile['firstname'] ?></span></p></td>
					<td class="tr1 td16"><p class="p7 ft16"><span class="ft2">4. Data urodzenia </span>(dzień - miesiąc - rok)</p></td>
				</tr>
				<tr>
					<td class="tr4 td0"></td>
					<td class="tr4 td17"><p class="p6 ft15">&nbsp;</p></td>
					<td class="tr4 td8"><p class="p6 ft15">&nbsp;</p></td>
					<td class="tr4 td18"><p class="p6 ft15">&nbsp;</p></td>
					<td class="tr4 td19"><p class="p6 ft15">&nbsp;</p></td>
					<td class="tr4 td9 ft3" style="font-size:9px; max-width: 170px;">

						<table style="text-align: center; max-width: 170px;">
							<tr>
								<td> <?php if (isset($profile)) echo substr($profile['date_of_birth'], -2, 1) ?> </td>
								<td> <?php if (isset($profile)) echo substr($profile['date_of_birth'], -1) ?> </td>
								<td> - </td>

								<td> <?php if (isset($profile)) echo substr($profile['date_of_birth'], -5, 1) ?> </td>
								<td> <?php if (isset($profile)) echo substr($profile['date_of_birth'], -4, 1) ?> </td>
								<td> - </td>

								<td> <?php if (isset($profile)) echo substr($profile['date_of_birth'], 0, 1) ?> </td>
								<td> <?php if (isset($profile)) echo substr($profile['date_of_birth'], 1, 1) ?> </td>
								<td> <?php if (isset($profile)) echo substr($profile['date_of_birth'], 2, 1) ?> </td>
								<td> <?php if (isset($profile)) echo substr($profile['date_of_birth'], 3, 1) ?> </td>
							</tr>
							<tr>
								<td>└┘</td>
								<td>└┘</td>
								<td>  </td>

								<td>└┘</td>
								<td>└┘</td>
								<td>  </td>

								<td>└┘</td>
								<td>└┘</td>
								<td>└┘</td>
								<td>└┘</td>
							</tr>
						</table>

				</tr>
			</tbody></table>
		<p class="p9 ft18">Niniejszym określam płatnika:</p>

		<br/>
		<p class="p4kuku ft0" style="font-size: 120%"><?php if (isset($profile)) echo $profile['company_name']; ?></p>


		<table cellspacing="0" cellpadding="0" class="t1">
			<tbody><tr>
					<td class="tr2 td20"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td22"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td22"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td22"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td22"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td22"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td22"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td22"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td22"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td22"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td22"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td22"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td22"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td22"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td22"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td22"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td22"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td22"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td22"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td22"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td22"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td22"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td22"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td22"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td22"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td22"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td22"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td21"><p class="p10 ft17">.</p></td>
					<td class="tr2 td22"><p class="p10 ft17">.</p></td>
				</tr>
			</tbody></table>
		<p class="p11 ft0">(nazwa pełna zakładu pracy)</p>
		<p class="p12 ft19">jako właściwego do zmniejszania miesięcznej zaliczki na podatek dochodowy o kwotę stanowiącą 1/12 kwoty zmniejszającej podatek, określonej w pierwszym przedziale obowiązującej skali podatkowej, gdyż:</p>
		<p class="p13 ft18"><span class="ft18">1)</span><span class="ft20">nie otrzymuję emerytury lub renty za pośrednictwem płatnika,</span></p>
		<p class="p14 ft19"><span class="ft18">2)</span><span class="ft21">nie osiągam dochodów z tytułu członkostwa w rolniczej spółdzielni produkcyjnej lub innej spółdzielni zajmującej się produkcją rolną,</span></p>
		<p class="p15 ft19"><span class="ft18">3)</span><span class="ft22">nie otrzymuję świadczeń pieniężnych wypłacanych z Funduszu Pracy lub z Funduszu Gwarantowanych Świadczeń Pracowniczych,</span></p>
		<p class="p16 ft19"><span class="ft18">4)</span><span class="ft23">nie osiągam dochodów, od których jestem </span><nobr>obowiązany(-na)</nobr> opłacać w ciągu roku podatkowego zaliczki na podstawie art. 44 ust. 3 ustawy, tj. dochodów:</p>
		<p class="p17 ft18"><span class="ft9">a)</span><span class="ft20">z działalności gospodarczej, o której mowa w art. 14 ustawy,</span></p>
		<p class="p18 ft18"><span class="ft9">b)</span><span class="ft20">z najmu lub dzierżawy.</span></p>
		<p class="p19 ft14"><span class="ft14">B.</span><span class="ft24">PODPIS</span></p>
		<table cellspacing="0" cellpadding="0" class="t2">
			<tbody><tr>
					<td class="tr3 td23"><p class="p6 ft16"><span class="ft2">5. Data wypełnienia </span>(dzień - miesiąc - rok)</p></td>
					<td class="tr3 td24"><p class="p6 ft25">6. Podpis</p></td>
				</tr>
			</tbody></table>
		<p class="p20 ft27"><nobr>└────┴────┘<span class="ft26">-</span>└────┴────┘<span class="ft26">-</span>└────┴────┴────┴────┘</nobr></p>
		<p class="p21 ft28">Pouczenie</p>
		<p class="p22 ft9">Za podanie nieprawdy lub zatajenie prawdy i przez to narażenie podatku na uszczuplenie grozi odpowiedzialność przewidziana w Kodeksie karnym skarbowym.</p>
		<p class="p23 ft28">Objaśnienia</p>
		<p class="p24 ft9">Oświadczenie należy złożyć płatnikowi przed pierwszą wypłatą wynagrodzenia w roku podatkowym.</p>
		<p class="p25 ft9">Oświadczenia nie składa się, jeżeli stan faktyczny wynikający z oświadczenia złożonego w latach poprzednich nie uległ zmianie.</p>
		<p class="p26 ft29">Jeżeli podatnik powiadomi zakład pracy o zmianie stanu faktycznego wynikającego z oświadczenia, zakład pracy nie zmniejsza zaliczki w wyżej określony sposób.</p>
	</div>
	<div id="id_4">
		<p class="p0 ft5"><nobr>PIT-2<span class="ft26">(4)</span></nobr><span class="ft26"> </span><span class="ft4">1</span><span class="ft0">/1</span></p>
	</div>
</div>
<style type="text/css">

	body {margin-top: 0px;margin-left: 0px;}

	#page_1 {position:relative; overflow: hidden;margin: 24px 0px 27px 31px;padding: 0px;border: none;width: 763px;height: 1072px;}
	#page_1 #id_1 {border:none;margin: 0px 0px 0px 98px;padding: 0px;border:none;width: 665px;overflow: hidden;}
	#page_1 #id_2 {border:none;margin: 4px 0px 0px 5px;padding: 0px;border:none;width: 758px;overflow: hidden;}
	#page_1 #id_2 #id_2_1 {float:left;border:none;margin: 2px 0px 0px 0px;padding: 0px;border:none;width: 623px;overflow: hidden;}
	#page_1 #id_2 #id_2_2 {float:left;border:none;margin: 0px 0px 0px 0px;padding: 0px;border:none;width: 135px;overflow: hidden;}
	#page_1 #id_3 {border:none;margin: 13px 0px 0px 0px;padding: 0px;border:none;width: 763px;overflow: hidden;}
	#page_1 #id_4 {border:none;margin: 162px 0px 0px 602px;padding: 0px;border:none;width: 161px;overflow: hidden;}

	#page_1 #dimg1 {position:absolute;top:10px;left:0px;z-index:-1;width:726px;height:1062px;}
	#page_1 #dimg1 #img1 {width:726px;height:1062px;}




	.ft0{font: 8px 'Arial';line-height: 10px;}
	.ft1{font: 7px 'Arial';line-height: 7px;position: relative; bottom: 3px;}
	.ft2{font: bold 9px 'Arial';line-height: 11px;}
	.ft3{font: bold 7px 'Courier New';line-height: 8px;}
	.ft4{font: 13px 'Arial';line-height: 16px;}
	.ft5{font: bold 19px 'Arial';line-height: 22px;}
	.ft6{font: bold 16px 'Arial';line-height: 21px;}
	.ft7{font: bold 13px 'Arial';line-height: 18px;}
	.ft8{font: bold 13px 'Arial';line-height: 16px;}
	.ft9{font: 11px 'Arial';line-height: 14px;}
	.ft10{font: 10px 'Arial';line-height: 13px;}
	.ft11{font: 1px 'Arial';line-height: 13px;}
	.ft12{font: 11px 'Arial';line-height: 14px;position: relative; bottom: -4px;}
	.ft13{font: 1px 'Arial';line-height: 5px;}
	.ft14{font: bold 16px 'Arial';line-height: 19px;}
	.ft15{font: 1px 'Arial';line-height: 1px;}
	.ft16{font: 9px 'Arial';line-height: 12px;}
	.ft17{font: bold 7px 'Arial';line-height: 7px;}
	.ft18{font: 12px 'Arial';line-height: 15px;}
	.ft19{font: 12px 'Arial';line-height: 18px;}
	.ft20{font: 12px 'Arial';margin-left: 4px;line-height: 15px;}
	.ft21{font: 12px 'Arial';margin-left: 5px;line-height: 18px;}
	.ft22{font: 12px 'Arial';margin-left: 9px;line-height: 18px;}
	.ft23{font: 12px 'Arial';margin-left: 3px;line-height: 18px;}
	.ft24{font: bold 16px 'Arial';margin-left: 5px;line-height: 19px;}
	.ft25{font: bold 8px 'Arial';line-height: 10px;}
	.ft26{font: 7px 'Arial';line-height: 7px;}
	.ft27{font: 7px 'Courier New';line-height: 8px;}
	.ft28{font: bold 12px 'Arial';line-height: 15px;}
	.ft29{font: 11px 'Arial';line-height: 15px;}

	.p0{text-align: left;margin-top: 0px;margin-bottom: 0px;}
	.p1{text-align: left;padding-left: 85px;margin-top: 12px;margin-bottom: 0px;}
	.p2{text-align: left;padding-left: 5px;margin-top: 0px;margin-bottom: 0px;}
	.p3{text-align: left;padding-left: 319px;padding-right: 344px;margin-top: 3px;margin-bottom: 0px;text-indent: -24px;}
	.p4{text-align: left;padding-left: 80px;margin-top: 0px;margin-bottom: 0px;}
	.p4kuku{text-align: center;padding-left: 0px;margin-top: 0px;margin-bottom: 0px;}
	.p5{text-align: left;padding-left: 5px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
	.p6{text-align: left;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
	.p7{text-align: left;padding-left: 4px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
	.p8{text-align: left;padding-left: 21px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
	.p9{text-align: left;padding-left: 12px;margin-top: 8px;margin-bottom: 0px;}
	.p10{text-align: right;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
	.p11{text-align: left;padding-left: 322px;margin-top: 4px;margin-bottom: 0px;}
	.p12{text-align: left;padding-left: 15px;padding-right: 54px;margin-top: 30px;margin-bottom: 0px;}
	.p13{text-align: justify;padding-left: 14px;margin-top: 20px;margin-bottom: 0px;}
	.p14{text-align: justify;padding-left: 30px;padding-right: 54px;margin-top: 4px;margin-bottom: 0px;text-indent: -15px;}
	.p15{text-align: justify;padding-left: 30px;padding-right: 54px;margin-top: 1px;margin-bottom: 0px;text-indent: -15px;}
	.p16{text-align: justify;padding-left: 29px;padding-right: 54px;margin-top: 2px;margin-bottom: 0px;text-indent: -14px;}
	.p17{text-align: justify;padding-left: 30px;margin-top: 2px;margin-bottom: 0px;}
	.p18{text-align: justify;padding-left: 30px;margin-top: 3px;margin-bottom: 0px;}
	.p19{text-align: justify;padding-left: 7px;margin-top: 35px;margin-bottom: 0px;}
	.p20{text-align: left;padding-left: 100px;margin-top: 42px;margin-bottom: 0px;}
	.p21{text-align: left;padding-left: 334px;margin-top: 16px;margin-bottom: 0px;}
	.p22{text-align: left;padding-left: 19px;padding-right: 40px;margin-top: 5px;margin-bottom: 0px;}
	.p23{text-align: left;padding-left: 328px;margin-top: 11px;margin-bottom: 0px;}
	.p24{text-align: left;padding-left: 18px;margin-top: 6px;margin-bottom: 0px;}
	.p25{text-align: left;padding-left: 18px;margin-top: 7px;margin-bottom: 0px;}
	.p26{text-align: left;padding-left: 17px;padding-right: 42px;margin-top: 3px;margin-bottom: 0px;text-indent: 1px;}

	.td0{padding: 0px;margin: 0px;width: 0px;vertical-align: bottom;}
	.td1{border-left: #000000 1px solid;border-top: #000000 1px solid;padding: 0px;margin: 0px;width: 107px;vertical-align: bottom;background: #dfdfdf;}
	.td2{border-right: #000000 1px solid;border-top: #000000 1px solid;padding: 0px;margin: 0px;width: 613px;vertical-align: bottom;background: #dfdfdf;}
	.td3{border-left: #000000 1px solid;border-right: #dfdfdf 1px solid;padding: 0px;margin: 0px;width: 28px;vertical-align: bottom;background: #dfdfdf;}
	.td4{padding: 0px;margin: 0px;width: 78px;vertical-align: bottom;background: #dfdfdf;}
	.td5{border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 403px;vertical-align: bottom;}
	.td6{border-right: #000000 1px solid;padding: 0px;margin: 0px;width: 210px;vertical-align: bottom;}
	.td7{border-left: #000000 1px solid;border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 29px;vertical-align: bottom;}
	.td8{border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 78px;vertical-align: bottom;}
	.td9{border-right: #000000 1px solid;border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 210px;vertical-align: bottom;}
	.td10{border-left: #000000 1px solid;border-right: #dfdfdf 1px solid;padding: 0px;margin: 0px;width: 509px;vertical-align: bottom;background: #dfdfdf;}
	.td11{border-right: #000000 1px solid;padding: 0px;margin: 0px;width: 210px;vertical-align: bottom;background: #dfdfdf;}
	.td12{border-left: #000000 1px solid;border-right: #000000 1px solid;border-top: #dfdfdf 1px solid;padding: 0px;margin: 0px;width: 28px;vertical-align: bottom;background: #dfdfdf;}
	.td13{border-top: #000000 1px solid;padding: 0px;margin: 0px;width: 78px;vertical-align: bottom;}
	.td14{border-right: #000000 1px solid;border-top: #000000 1px solid;padding: 0px;margin: 0px;width: 180px;vertical-align: bottom;}
	.td15{border-right: #000000 1px solid;border-top: #000000 1px solid;padding: 0px;margin: 0px;width: 221px;vertical-align: bottom;}
	.td16{border-right: #000000 1px solid;border-top: #000000 1px solid;padding: 0px;margin: 0px;width: 210px;vertical-align: bottom;}
	.td17{border-left: #000000 1px solid;border-right: #000000 1px solid;border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 28px;vertical-align: bottom;background: #dfdfdf;}
	.td18{border-right: #000000 1px solid;border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 180px;vertical-align: bottom;}
	.td19{border-right: #000000 1px solid;border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 221px;vertical-align: bottom;}
	.td20{padding: 0px;margin: 0px;width: 2px;vertical-align: bottom;}
	.td21{padding: 0px;margin: 0px;width: 10px;vertical-align: bottom;}
	.td22{padding: 0px;margin: 0px;width: 9px;vertical-align: bottom;}
	.td23{padding: 0px;margin: 0px;width: 260px;vertical-align: bottom;}
	.td24{padding: 0px;margin: 0px;width: 41px;vertical-align: bottom;}

	.tr0{height: 4px;}
	.tr1{height: 15px;}
	.tr2{height: 10px;}
	.tr3{height: 13px;}
	.tr4{height: 18px;}
	.tr5{height: 5px;}
	.tr6{height: 25px;}

	.t0{width: 721px;margin-top: 39px;font: 11px 'Arial';}
	.t1{width: 675px;margin-left: 24px;margin-top: 31px;font: bold 7px 'Arial';}
	.t2{width: 301px;margin-left: 34px;margin-top: 3px;font: bold 8px 'Arial';}

</style>