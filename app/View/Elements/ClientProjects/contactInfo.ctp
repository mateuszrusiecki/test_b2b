 <div class="row well">
            <div class="col-md-2">
                <?php echo __d('public', 'Klient') ?>
            </div>
            <div class="col-md-10">
                <b><?php echo $clientLead['Client']['name']; ?></b><br />
                <?php echo $clientLead['Client']['street']; ?><br />
                <?php echo $clientLead['Client']['zipcode']; ?>
                <?php echo $clientLead['Client']['city']; ?><br />
                <?php echo $clientLead['Client']['country']; ?><br />
            </div>
        </div>