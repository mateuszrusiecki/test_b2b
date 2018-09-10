

<?php echo $this->Metronic->portlet(__d('public', 'Dane faktury')); ?>


<div class="wrapper">

    <div class="clearfix tr col-md-3">
        <div class="fl">
            <?php echo __d('public', 'Data wystawienia'); ?>:
        </div>
        <?php echo date("d-m-Y", strtotime($invoice['Invoice']['created'])); ?>

        <div class="fl">
            <?php echo __d('public', 'Data dostawy / wykonania usługi'); ?>:
        </div>
        <?php echo date("d-m-Y", strtotime($invoice['Invoice']['created'])); ?>
    </div>

    <div class="clearfix">
        <div class="leftPage col-md-3">
            <div id="buyer">

                <?php echo __d('public', 'Nabywca'); ?> :<br>
                <?php echo $invoice['Client']['name'] ?><br>
                <?php echo $invoice['Client']['street'] ?><br>
                <?php echo $invoice['Client']['zipcode'] ?> <?php echo $invoice['Client']['city'] ?><br>
                NIP: <?php echo $invoice['Client']['nip'] ?>

            </div>
        </div>

    </div>

    <div class="table-scrollable">
        <table class="table table-striped table-bordered table-advance table-hover">
            <thead>
                <tr class="b">
                    <td>Lp.</td>
                    <td><?php echo __d('public', 'Nazwa towaru/usługi'); ?></td>
                    <td><?php echo __d('public', 'PKWiU'); ?></td>
                    <td><?php echo __d('public', 'Ilość'); ?></td>
                    <td><?php echo __d('public', 'J.m.'); ?></td>
                    <td><?php echo __d('public', 'VAT'); ?></td>
                    <td><?php echo __d('public', 'Cena netto'); ?></td>
                    <td><?php echo __d('public', 'Wartość netto'); ?></td>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
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
                        <td><?php echo number_format($inv_pos['unit_price'], 2) ?> zł</td>
                        <td><?php echo number_format($inv_pos['net_value'], 2) ?> zł</td>
                    </tr>
                    <?php
                    $i++;
                    $net_val_sum += $inv_pos['net_value'];
                    $tax_val_sum += $inv_pos['tax_value'];
                    $gross_val_sum += $inv_pos['gross_value'];
                    ?>
                <?php endforeach; ?>

                <tr class="grey b">
                    <td><?php echo __d('public', 'Forma płatności'); ?></td>
                    <td><?php echo __d('public', 'Termin'); ?></td>
                    <td><?php echo __d('public', 'Kwota'); ?></td>
                    <td colspan="2"><?php echo __d('public', 'Stawka'); ?></td>
                    <td><?php echo __d('public', 'Netto'); ?></td>
                    <td><?php echo __d('public', 'VAT'); ?></td>
                    <td><?php echo __d('public', 'Brutto'); ?></td>
                </tr>
                <tr>
                    <td rowspan="2">
                        <?php echo $invoice['Invoice']['payment_type'] ?>
                    </td>
                    <td rowspan="2">
                        <?php echo $invoice['Invoice']['payment_date'] ?>
                    </td>
                    <td rowspan="2">
                        <?php echo number_format($gross_val_sum, 2) ?> zł
                    </td>
                    <td class="grey bb">
                        <?php echo __d('public', 'Razem'); ?>:
                    </td>
                    <td class="bb"></td>
                    <td class="bb"><?php echo number_format($net_val_sum, 2) ?> zł</td>
                    <td class="bb"><?php echo number_format($tax_val_sum, 2) ?> zł</td>
                    <td class="bb"><?php echo number_format($gross_val_sum, 2) ?> zł</td>
                </tr>
                <tr>  
                    <td class="grey"><?php echo __d('public', 'W tym'); ?>:</td>
                    <td> 23%</td>
                    <td class="bb"><?php echo number_format($net_val_sum, 2) ?> zł</td>
                    <td class="bb"><?php echo number_format($tax_val_sum, 2) ?> zł</td>
                    <td class="bb"><?php echo number_format($gross_val_sum, 2) ?> zł</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
<div id="summary">
    <div class="grey clearfix">
        <div class="fl">
            <?php echo __d('public', 'Razem do zapłaty'); ?>: 
        </div>
        <strong><?php echo number_format($gross_val_sum, 2) ?> PLN</strong> 
    </div>
    <?php $tmp = explode('.', number_format($gross_val_sum, 2)) ?>
    <?php //echo __d('public','Słownie').' '.$invoice['Invoice']['slownie'].' zł '.$tmp[1].'/100';  ?>
</div>

<br/><br/>

<h3 class="text-center"><?php echo __d('public', 'Dodaj fakturę w Comarch Optima a następnie wklej poniżej numer utworzonej faktury'); ?>:</h3>

<div class="row col-md-3">
    <?php
    $urlForm = array('controller' => 'hrs', 'action' => 'synchronize_invoice');
    echo $this->Form->create('Invoice', array('url' => $urlForm));
    ?>
    <?php echo $this->Form->hidden('id', array('value' => $invoice['Invoice']['id'])) ?>
    <?php echo $this->Metronic->input('invoice_nr', array('label' => __d('public', 'Numer faktury'))); ?>    
    <a href="/fronts/m_secretariat" class="btn blue-madison pull-left" > <?php echo __d('public', 'Powrót'); ?></a>
    <?php
    echo $this->Form->submit(__d('public', 'Zapisz'), array('class' => 'btn blue-madison pull-left'));
    echo $this->Form->end();
    ?>
</div>

<?php echo $this->Metronic->portletEnd(); ?>