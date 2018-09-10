
<?php echo $this->Metronic->portlet(__d('public', 'Wysyłanie sms')); ?>
<div class="row">
    <div class="col-md-12">
       <?php echo $this->Form->create('sms', array('url' => array('controller' => 'fronts', 'action' => 'sms'))); ?>

    <table>
        <tr>
            <td><label class="fleft"><?php echo __d('public', 'Numer telefonu z kierunkowym(np. 48500500500)') ?></label>
				<br/><?php
                echo $this->Metronic->input('to', array(
                    'label' => false,
                    'class' => 'form-control',
                    'type' => 'text',
					'required' => 'required',
					'maxlength' => '11'
                ));
                ?>
            </td>
        </tr>
        <tr>
            <td><label class="fleft"><?php echo __d('public', 'Wiadomość') ?></label>
				<br/><?php
                echo $this->Metronic->input('message', array(
                    'label' => false,
                    'class' => 'form-control',
                    'type' => 'textarea',
					'required' => 'required',
					'maxlength' => '134'
                ));
                ?>
            </td>
        </tr>
    </table>

    <?php
    $options = array(
        'label' => __d('public', 'Wyślij'),
        'class' => 'btn green-haze clear'
    );
    ?>

    <?php echo $this->Form->end($options); ?>

    </div>
</div>
<?php echo $this->Metronic->portletEnd(); ?>