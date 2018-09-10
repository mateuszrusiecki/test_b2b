<div id="formId" class="formContact">

    <?php
    echo $this->Form->create('FormContact', array('id' => 'contactForm', 'type' => 'put'));
    if (count($kontakty) > 1) {       
        echo $this->Form->input('toEmail', array('options' => $kontakty, 'label' => __d('public', 'Wyślij do: ')));
    } else {
        echo $this->Form->hidden('toEmail', array('value' => current(array_keys($kontakty))));
    }    
    echo $this->Form->input('companyName', array('label' => __d('public', 'Nazwa firmy: ')));
    echo $this->Form->input('person', array('label' => __d('public', 'Osoba kontaktowa:')));
    echo $this->Form->input('address', array('label' => __d('public', 'Adres:')));
    echo $this->Form->input('phone', array('label' => __d('public', 'Telefon/fax')));
    echo $this->Form->input('email', array('label' => __d('public', 'Email:')));
    echo $this->Form->input('content', array('type' => 'textarea', 'label' => __d('public', 'Treść zapytania:')));
    echo $this->Form->input('Wyślij', array('type' => 'submit', 'label' => false, 'id' => 'submitButton'));

    echo $this->Form->end();
    ?>

    <script type="text/javascript">
        $(function(){
            $("#contactForm").unbind('submit');
            $("#contactForm").submit( function(e) {
                $.ajax({
                    url: '<?php echo $this->Html->url(array('action' => 'index')); ?>',
                    dataType: 'html',
                    data: $("#contactForm").serialize(),
                    type: 'post',
                    success: function(html) {
                        $("#formId").replaceWith(html);
                    },
                    error: function() {
                        console.debug('nie bangla');
                    }
                });
                $("#submitButton").attr("disabled", 'disabled');
                e.preventDefault();
            });     
        });
    </script>
</div>