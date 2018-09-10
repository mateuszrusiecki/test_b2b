<div class="col-md-6 col-xs-12">
    <?php
    echo $this->Metronic->input('name', array('label' => __('Tytuł')));
//    echo Configure::read('Page.hasPhotos') ? $this->Metronic->input('Page.gallery', array('type' => 'checkbox', 'label' => 'Galeria')) : '';
//    echo Configure::read('Page.hasComments') ? $this->Metronic->input('comments', array('label' => 'Komentarze')) : '';
    ?>
</div>
<div class="col-xs-12">
    <label>Treść</label>
    <?php echo $this->FebTinyMce4->input('desc', array('label' => __('Treść'), 'id' => 'test'), 'full'); ?>
</div>
<div class="col-md-6 col-xs-12">
    <h3>Ustawienia HTML</h3>
    <div class="info">
        Maksymalna ilość znaków 255
    </div>
    <?php
    echo $this->Metronic->input('meta_title', array('label' => 'Tytuł strony'));
    echo $this->Metronic->input('description', array('label' => 'Keywords'));
    echo $this->Metronic->input('keywords', array('label' => 'Opis'));
    ?>
</div>