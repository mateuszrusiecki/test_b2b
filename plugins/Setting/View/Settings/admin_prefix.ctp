<?php echo $this->Metronic->portlet($title_for_layout); ?>

<div class="portlet-body">
    <div class="row">
        <div class="col-xs-12">
            <?php
            echo $this->Form->create('Setting', array(
                'url' => array(
                    'controller' => 'settings',
                    'action' => 'prefix',
                    $prefix,
                ),
            ));
            ?>
                <?php
                $i = 0;

                foreach ($settings AS $setting) {
                    $key = $setting['Setting']['key'];
                    $keyE = explode('.', $key);
                    $keyTitle = Inflector::humanize($keyE['1']);

                    $label = $keyTitle;
                    if ($setting['Setting']['title'] != null) {
                        $label = $setting['Setting']['title'];
                    }

                    $inputType = 'text';
                    if ($setting['Setting']['input_type'] != null) {
                        $inputType = $setting['Setting']['input_type'];
                    }

                    echo '<div class="setting">';
                    echo $this->Metronic->input("Setting.$i.id", array('value' => $setting['Setting']['id']));
                    echo $this->Metronic->input("Setting.$i.key", array('type' => 'hidden', 'value' => $key));
                    if ($setting['Setting']['input_type'] == 'checkbox') {
                        if ($setting['Setting']['value'] == 1) {
                            echo $this->Metronic->input("Setting.$i.value", array(
                                'label' => $label,
                                'type' => $setting['Setting']['input_type'],
                                'checked' => 'checked',
                                'rel' => $setting['Setting']['description'],
                                'title' => $setting['Setting']['description'],
                            ));
                        } else {
                            echo $this->Metronic->input("Setting.$i.value", array(
                                'label' => $label,
                                'type' => $setting['Setting']['input_type'],
                                'rel' => $setting['Setting']['description'],
                                'title' => $setting['Setting']['description'],
                            ));
                        }
                    } elseif ($setting['Setting']['input_type'] == 'tinymce') {
                        echo $this->FebTinyMce4->input("Setting.$i.value", array(
                            'label' => $label,
                            'type' => $inputType,
                            'value' => $setting['Setting']['value'],
                            'rel' => $setting['Setting']['description'],
                            'id' => "Setting{$i}value",
                            'title' => $setting['Setting']['description'],
                                ), 'full');
                    } else {
                        echo $this->Metronic->input("Setting.$i.value", array(
                            'label' => $label,
                            'type' => $inputType,
                            'value' => $setting['Setting']['value'],
                            'rel' => $setting['Setting']['description'],
                            'title' => $setting['Setting']['description'],
                        ));
                    }
                    echo "</div>";
                    $i++;
                }
                ?>
            <div class="pull-right">
                <?php
                echo $this->Form->submit('Zapisz', array('class' => 'btn blue-madison pull-right'));
                echo $this->Form->end();
                ?>
            </div>
        </div>

    </div>
</div>
<?php echo $this->Metronic->portletEnd(); ?>
