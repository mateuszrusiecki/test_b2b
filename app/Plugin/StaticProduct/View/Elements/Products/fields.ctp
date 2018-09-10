<?php $this->Html->script('jquery.febmultiple', array('inline' => false)); ?>
<fieldset>
    <legend><?php echo __d('cms', 'Product Data'); ?></legend>
    <?php echo $this->Form->input('title', array('label' => __d('cms', 'Title'))); ?>
    <?php echo $this->Form->input('promoted', array('label' => __d('cms', 'Promowany na głównej'))); ?>
    <?php echo $this->FebForm->file('pdf', array('label' => __d('cms', 'Pełna broszura produktu'))); ?>
</fieldset>

<fieldset>
    <legend><?php echo __d('cms', 'Skrócony opis'); ?></legend>
    <?php echo $this->FebTinyMce4->input('tiny_content', array('label' => false), 'full'); ?>
</fieldset>

<fieldset>
    <legend><?php echo __d('cms', 'Content'); ?></legend>
    <?php echo $this->FebTinyMce4->input('content', array('label' => false), 'full', array('width' => 718)); ?>
</fieldset>

<fieldset>
    <legend><?php echo __d('cms', 'Dane techniczne'); ?></legend>
    <?php echo $this->FebTinyMce4->input('tech', array('label' => false), 'full', array('width' => 718)); ?>
</fieldset>

<fieldset>
    <legend><?php echo __d('cms', 'Zastosowania'); ?></legend>
    <?php echo $this->FebTinyMce4->input('application', array('label' => false), 'full', array('width' => 718)); ?>
</fieldset>

<fieldset>
    <legend><?php echo __d('cms', 'Wygląd produktu'); ?></legend>
    <?php echo $this->FebTinyMce4->input('layout', array('label' => false), 'full', array('width' => 718)); ?>
</fieldset>

<fieldset>
    <h2><span></span><?php echo __d('cms', 'Podobne produkty'); ?></h2>
    <?php echo $this->Form->input('SimilarProduct.SimilarProduct', array('type' => 'select', 'id' => 'ProductSimilar', 'multiple' => true, 'label' => false)); ?>
</fieldset>

<fieldset>
    <h2><span></span><?php echo __d('cms', 'Akcesoria'); ?></h2>
    <?php echo $this->Form->input('Accessory.Accessory', array('type' => 'select', 'id' => 'Accessory', 'multiple' => true, 'label' => false)); ?>
</fieldset>

<fieldset class="multiple">
    <h2><span></span><?php echo __d('cms', 'Kategorie'); ?></h2>
    <?php echo $this->Form->input('ProductCategory.ProductCategory', array('multiple' => 'checkbox', 'label' => false)); ?>
</fieldset>

<script type="text/javascript">                   
    $(function(){
        $('#ProductSimilar').febMultiple({
            defaultHtml: 'Dodaj podobne produkty',
            /**
             * Wymagana funkcja, wywołuje się po kliknięciu dodaj w dialogu, 
             * musi zaktualizować rejestr przed wywołaniem odswiezenia contentu inline
             */
            updateRegister: function() {
                //Dodaje do rejestru, nowych pól
                var $this = this;
                $('#SimilarProduct input[type="checkbox"]:checked').each(function(){
                    $this.febMultiple('add', parseInt($(this).val()));
                });
            },
            afterAdd: function(content, response) {
                var $this = $(this);
                //Ustawiam button do usuwania
                content.find('.similar_products button').button();
                content.find('.similar_products button').click(function(e){
                    var tr = $(this).parents('tr');
                    var tbody = tr.parents('tbody');
                    
                    $this.febMultiple('remove', tr.attr('data-id'));
                    tr.remove();
                    if (!tbody.find('tr').length) {
                        tbody.parent().remove();
                    }
                    e.preventDefault();
                    
                });
            },
            inlineEditUrl: '<?php echo $this->Html->url(array('action' => 'multiselect_index')); ?>.json',
            /**
             * Ajaxowa akcja contentu okienka wyboru
             */
            data: {
                url: '<?php echo $this->Html->url(array('action' => 'multiselect')); ?>',
                data: {
                    data: {
                        Product: {
                            id: <?php echo !empty($this->data['Product']['id']) ? $this->data['Product']['id']: 'null'; ?>,
                            selection_id: <?php echo $selection; ?>
                        }
                    }
                }
            },
            dialog: {
                title: 'Dodaj podobne produkty'
            }
        });
    
<?php if (!empty($this->data['SimilarProduct']['SimilarProduct'])): ?>
            $('#ProductSimilar').febMultiple('create', <?php echo json_encode($this->data['SimilarProduct']['SimilarProduct']); ?>);
<?php endif; ?>
            
<?php if (!empty($this->data['SimilarProduct'][0])): ?>
            $('#ProductSimilar').febMultiple('create', <?php echo json_encode(array_values(Set::combine($this->data['SimilarProduct'], '{n}.id', '{n}.id'))); ?>);
<?php endif; ?>
            
        $('#Accessory').febMultiple({
            defaultHtml: 'Dodaj akcesoria',
            /**
             * Wymagana funkcja, wywołuje się po kliknięciu dodaj w dialogu, 
             * musi zaktualizować rejestr przed wywołaniem odswiezenia contentu inline
             */
            updateRegister: function() {
                //Dodaje do rejestru, nowych pól
                var $this = this;
                $('#SimilarProduct input[type="checkbox"]:checked').each(function(){
                    $this.febMultiple('add', parseInt($(this).val()));
                });
            },
            afterAdd: function(content, response) {
                var $this = $(this);
                //Ustawiam button do usuwania
                content.find('.similar_products button').button();
                content.find('.similar_products button').click(function(e){
                    var tr = $(this).parents('tr');
                    var tbody = tr.parents('tbody');
                    
                    $this.febMultiple('remove', tr.attr('data-id'));
                    tr.remove();
                    if (!tbody.find('tr').length) {
                        tbody.parent().remove();
                    }
                    e.preventDefault();
                });
            },
            inlineEditUrl: '<?php echo $this->Html->url(array('action' => 'multiselect_index')); ?>.json',
            /**
             * Ajaxowa akcja contentu okienka wyboru
             */
            data: {
                url: '<?php echo $this->Html->url(array('action' => 'multiselect')); ?>',
                data: {
                    data: {
                        Product: {
                            selection_id: <?php echo $selection; ?>
                        }
                    }
                }
            },
            dialog: {
                title: 'Dodaj akcesoria'
            }
        });
    
<?php if (!empty($this->data['Accessory']['Accessory'])): ?>
            $('#Accessory').febMultiple('create', <?php echo json_encode($this->data['Accessory']['Accessory']); ?>);
<?php endif; ?>
            
<?php if (!empty($this->data['Accessory'][0])): ?>
            $('#Accessory').febMultiple('create', <?php echo json_encode(array_values(Set::combine($this->data['Accessory'], '{n}.id', '{n}.id'))); ?>);
<?php endif; ?>
    });
    
</script>