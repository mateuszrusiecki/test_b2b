<?php
$this->Html->css($this->Html->url('/css/invoice.css', true), null, array('inline' => false));
$this->Html->scriptBlock("document.createElement('header'); document.createElement('footer'); document.createElement('section'); document.createElement('article'); document.createElement('aside'); document.createElement('nav');", array('inline' => false));
//debug($invoice);
?>

<div class="wrapper">
    <div class="clearfix pb10">
        <div class="leftPage">

            <div id="seller"> 
                <?php echo __d('public','Sprzedawca');?> <br>
                Fabryka e-biznesu sp. z o.o.<br>
                ul. Trembeckiego 11A<br>
                <br>
                35-234 Rzeszów<br>
                <div class="clearfix tr bb">
                    <div class="fl">

                        NIP: 8133563947 
                    </div>
                    Nr tel.: 0178529246
                </div>
            </div>
        </div>
        <div class="rightPage">
            <div id="data">
                <div class="dataHeader pb10">
                    <div class="grey">
                        <?php echo __d('public','Faktura VAT');?>
                    </div>
                    nr <?php echo $invoice['Invoice']['invoice_nr'] ?>
                </div>

                <div class="clearfix tr">
                    <div class="fl">
                        <?php echo __d('public','Data wystawienia');?>:
                    </div>
                    <b><?php echo date("d-m-Y", strtotime($invoice['Invoice']['created'])); ?></b>
                </div>

                <div class="clearfix tr">
                    <div class="fl">
                        <?php echo __d('public','Data dostawy / wykonania usługi');?>:
                    </div>
                    <b><?php echo date("d-m-Y", strtotime($invoice['Invoice']['created'])); ?></b>
                </div>
                <div class="tr">
                    Strona: <b>1 / 1</b>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix">
        <div class="leftPage">
            <div id="buyer">

                <?php echo __d('public','Nabywca');?> :<br>
                <b>
                    <?php echo $invoice['Client']['name'] ?><br>
                    <br>
                    <?php echo $invoice['Client']['street'] ?><br>
                    <?php echo $invoice['Client']['zipcode'] ?> <?php echo $invoice['Client']['city'] ?><br>
                    NIP: <?php echo $invoice['Client']['nip'] ?>
                </b>
            </div>
        </div>
        <div class="rightPage">
            <div id="recipient">

                <?php echo __d('public','Odbiorca');?>:<br>
                <b>
                    <?php echo $invoice['Client']['name'] ?><br>
                    <br>
                    <?php echo $invoice['Client']['street'] ?><br>
                    <?php echo $invoice['Client']['zipcode'] ?> <?php echo $invoice['Client']['city'] ?><br>
                    NIP: <?php echo $invoice['Client']['nip'] ?>
                </b>
            </div>
        </div>
    </div>
    <table id="products">
        <thead>
            <tr class="b">
                <td>Lp.</td>
                <td><?php echo __d('public','Nazwa towaru/usługi');?></td>
                <td><?php echo __d('public','PKWiU');?></td>
                <td><?php echo __d('public','Ilość');?></td>
                <td><?php echo __d('public','J.m.');?></td>
                <td><?php echo __d('public','VAT');?></td>
                <td><?php echo __d('public','Cena netto');?></td>
                <td><?php echo __d('public','Wartość netto');?></td>
            </tr>
        </thead>
        <tbody>
			<?php 
				$i=1; 
				$net_val_sum = $tax_val_sum = $gross_val_sum = 0;
			?>
			<?php foreach ($invoice['InvoicePosition'] as $inv_pos) : ?>
				<tr>
					<td><?php echo $i ?></td>
					<td><?php echo $inv_pos['name'] ?></td>
					<td></td>
					<td><?php echo $inv_pos['quantity'] ?></td>
					<td><?php echo $inv_pos['jm'] ?></td>
					<td><?php echo $inv_pos['tax'] ?> %</td>
					<td><?php echo number_format($inv_pos['unit_price'],2) ?> zł</td>
					<td><?php echo number_format($inv_pos['net_value'],2) ?> zł</td>
				</tr>
			<?php 
				$i++; 
				$net_val_sum += $inv_pos['net_value'];
				$tax_val_sum += $inv_pos['tax_value'];
				$gross_val_sum += $inv_pos['gross_value'];
			?>
			<?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr class="grey b">
                <td><?php echo __d('public','Forma płatności');?></td>
                <td><?php echo __d('public','Termin');?></td>
                <td><?php echo __d('public','Kwota');?></td>
                <td colspan="2"><?php echo __d('public','Stawka');?></td>
                <td><?php echo __d('public','Netto');?></td>
                <td><?php echo __d('public','VAT');?></td>
                <td><?php echo __d('public','Brutto');?></td>
            </tr>
            <tr>
                <td rowspan="2">
					<?php echo $invoice['Invoice']['payment_type'] ?>
                </td>
                <td rowspan="2">
					<?php echo $invoice['Invoice']['payment_date'] ?>
                </td>
                <td rowspan="2">
					<?php echo number_format($gross_val_sum,2) ?> zł
                </td>
                <td class="grey bb">
                    <?php echo __d('public','Razem');?>:
                </td>
                <td class="bb"></td>
                <td class="bb"><?php echo number_format($net_val_sum,2) ?> zł</td>
                <td class="bb"><?php echo number_format($tax_val_sum,2) ?> zł</td>
                <td class="bb"><?php echo number_format($gross_val_sum,2) ?> zł</td>
            </tr>
            <tr>  
                <td class="grey"><?php echo __d('public','W tym');?>:</td>
                <td> 23%</td>
                <td class="bb"><?php echo number_format($net_val_sum,2) ?> zł</td>
                <td class="bb"><?php echo number_format($tax_val_sum,2) ?> zł</td>
                <td class="bb"><?php echo number_format($gross_val_sum,2) ?> zł</td>
            </tr>
        </tfoot>
    </table>
    <img style="max-width: 45%;" src="<?php echo $this->Html->url('/img/krd.png',true); ?>" />
</div>
<div id="summary">
    <div class="grey clearfix">
        <div class="fl">
            <?php echo __d('public','Razem do zapłaty');?>: 
        </div>
        <?php echo number_format($gross_val_sum,2) ?> PLN
    </div>
	<?php $tmp = explode('.',  number_format($gross_val_sum,2))?>
    <?php echo __d('public','Słownie');?>: <?php echo $invoice['Invoice']['slownie'] ?> zł <?php echo $tmp[1];  ?> /100
</div>

<table id="paid">
    <tr>
        <td class="bb"><?php echo __d('public','Zapłacono');?>:</td>
        <td class="bb"><?php echo number_format($invoice['Invoice']['paid_amount'],2) ?> zł</td>
        <td colspan="3" class="bb"></td>
        <td class="bb"><?php echo __d('public','Pozostaje');?>:</td>
        <td class="bb"><?php echo number_format($gross_val_sum - $invoice['Invoice']['paid_amount'],2) ?> zł</td>
    </tr>
    <tr>
        <td colspan="2" class="bb">
            Agnieszki Pańczak
        </td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td class="bb"></td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td colspan="2" class="bb"></td>
    </tr>
    <tr class="small">
        <td colspan="2">
            <?php echo __d('public','Podpis osoby uprawnionej do wystawienia faktury');?>
        </td>
        <td></td> 
        <td class="tc"><?php echo __d('public','Data odbioru');?></td>
        <td></td>
        <td colspan="2" class="tc"><?php echo __d('public','Podpis osoby uprawnionej do odbioru faktury');?></td>
    </tr>
    
</table>
