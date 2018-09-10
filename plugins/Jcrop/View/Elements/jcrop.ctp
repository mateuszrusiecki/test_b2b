<?php
$name = $data['name'];
$x = empty($data['x']) ? 0 : $data['x'];
$y = empty($data['y']) ? 0 : $data['y'];
$w = empty($data['w']) ? 0 : $data['w'];
$h = empty($data['h']) ? 0 : $data['h'];
$path = '/files/photo/' . $name;
$info = @getimagesize(WWW_ROOT . $path);

//$size = min((int)$info[0],(int)$info[1]);
$rx = 500 / $info[0];
$ry = 500 / $info[1];
$ratio = min($rx, $ry);
(int) $width = round($ratio * $info[0]);
(int) $height = round($ratio * $info[1]);
$size = min($width, $height);
//zabezpieczenie przed przekroczeniem zakresu
$x = round($ratio * $x);
$y = round($ratio * $y);
$w = round($ratio * $w);
$h = round($ratio * $h);

if (!empty($crops)) {
    foreach ($crops as &$crop) {
        $crop['Crop']['x'] = $x = round($ratio * $crop['Crop']['x']);
        $crop['Crop']['y'] = $y = round($ratio * $crop['Crop']['y']);
        $crop['Crop']['w'] = $w = round($ratio * $crop['Crop']['w']);
        $crop['Crop']['h'] = $h = round($ratio * $crop['Crop']['h']);
    }
    $setSelect = array($crops[0]['Crop']['x'], $crops[0]['Crop']['y'], $crops[0]['Crop']['x'] + $crops[0]['Crop']['w'], $crops[0]['Crop']['y'] + $crops[0]['Crop']['h']);
    $aspectRatio = $crops[0]['CropType']['ratio'];
} else {
    $setSelect = array($x, $y, $x + $w, $y + $h);
    $aspectRatio = 1;
}

//if ($x > ($width - $size) or $y > ($height - $size)) {
//    $x = 0;
//    $y = 0;
//}
?>

<div class="jcrop clearfix">
    <div class="actionJcrop">
        <div class="thumbJcrop" id="jcropId">
            <?php echo $this->Html->image($path, array('id' => 'preview')); ?>
        </div>
        <br /><br />
        <?php
        if (!empty($crops)) {
            foreach ($crops as &$crop) {
                echo $this->Html->link($crop['CropType']['label'], '#', array('escape' => false, 'onclick' => "changeScope.apply(this, [" . $crop['CropType']['id'] . "]);", 'default' => false)) . '<br />';
            }
        }
        ?>
        <div id="updateForm">
            <?php
            echo $this->Form->create('Jcrop', array('id' => 'JcropForm'));
            echo $this->Form->hidden('x', array('id' => 'JcropX', 'name' => 'data[x]', 'value' => $x, 'readonly'));
            echo $this->Form->hidden('y', array('id' => 'JcropY', 'name' => 'data[y]', 'value' => $y, 'readonly'));
            echo $this->Form->hidden('w', array('id' => 'JcropW', 'name' => 'data[w]', 'value' => $w, 'readonly'));
            echo $this->Form->hidden('h', array('id' => 'JcropH', 'name' => 'data[h]', 'value' => $h, 'readonly'));
            if (!empty($crops)) {
                echo $this->Form->hidden('active', array('id' => 'active', 'name' => 'active', 'value' => $active));
            }
            if ($childModel != 'Photo') {
                $submit['update'] = '#JcropForm';
            }
            $submit['url'] = array('controller' => 'jcrops', 'action' => 'update', 'plugin' => 'jcrop', 'admin' => false, $childModel, $id);
            $submit['id'] = 'autoSubmit';
            if ($childModel == 'Photo') {
                $submit['complete'] = 'saveMessage(); afterUpdate(); reload(' . $id . ');';
            } else {
                $submit['complete'] = 'jQuery("#editCrop").dialog("close");';
            }
            echo $this->Js->submit('zapisz', $submit);
            echo $this->Form->end();
            ?>
        </div>
        <div id="message"></div>
    </div>
    <div class="contentJcrop">
        <?php $styleImg = $this->Html->style(array('width' => $width . 'px !important', 'height' => $height . 'px !important')); ?>
        <?php echo $this->Html->image($path, array('class' => 'jcrop', 'id' => 'jcrop', 'style' => $styleImg)); ?>
    </div>
</div>

<script type="text/javascript">
    var crops = <?php echo!empty($crops) ? json_encode($crops) : "{}"; ?>;
    var cropType = '<?php echo!empty($crops) ? json_encode($crops[0]['CropType']['id']) : "{}"; ?>';

    api = $.Jcrop('#jcrop',{      
        setSelect: <?php echo $test = json_encode($setSelect); ?>,
        aspectRatio: <?php echo json_encode($aspectRatio); ?>,
        allowSelect: true,
        allowResize: true,
        onSelect: updateFeields,
        disable: true,
        onChange: showPreview,
        bgOpacity: .7
        
    });
    
    function afterUpdate() {
        ratio = <?php echo json_encode($ratio); ?>;
        var typeId = $('#active').val();
        for(key in crops) {            
            if(crops[key].CropType.id == typeId) {
                crops[key].Crop.x = ($('#JcropX').val()*ratio);
                crops[key].Crop.y = ($('#JcropY').val()*ratio);
                crops[key].Crop.w = ($('#JcropW').val()*ratio);
                crops[key].Crop.h = ($('#JcropH').val()*ratio);
            }
        }     
    }
    
    function saveMessage() {
        $("#message").stop().css("color", 'green').text('Poprawnie zapisano').fadeIn(800).fadeOut(2000);
    }
    
    function updateFeields(coords){
        ratio = <?php echo json_encode($ratio); ?>;
        jQuery('#JcropX').attr('value', Math.round(coords.x/ratio));
        jQuery('#JcropY').attr('value', Math.round(coords.y/ratio));
        jQuery('#JcropW').attr('value', Math.round(coords.w/ratio));
        jQuery('#JcropH').attr('value', Math.round(coords.h/ratio));
        jQuery('#autoSubmit').click();
    }
    //    function updateAjax(coords){
    //        // variables can be accessed here as
    //        // coords.x, coords.y, coords.x2, coords.y2, coords.w, coords.h
    //        $.ajax({
    //            type: 'POST',
    //            url: "<?php //echo $this->Html->url(array('controller' => 'jcrops', 'action' => 'update', 'plugin' => 'jcrop', 'admin' => false, $model, $id), true);                   ?>",
    //            data: ({
    //                'data[x]':Math.round(coords.x/ratio),
    //                'data[y]':Math.round(coords.y/ratio),
    //                'data[h]':Math.round(coords.h/ratio),
    //                'data[w]':Math.round(coords.w/ratio)
    //            }),
    //            //success: success,
    //            dataType: 'json'
    //        });        
    //    };
    
    function showPreview(coords){
        if(typeof(crops[0]) == 'undefined') {
            var rx = 100 / coords.w;
            var ry = 100 / coords.h; 
        }else {
            var typeId = $('#active').val();
            for(key in crops) {            
                if(crops[key].CropType.id == typeId) {
                    data = crops[key];
                }
            }
                var w =  200 / data.Crop.w;
                var rx =  ((data.Crop.w * w) / coords.w);
                var ry =  ((data.Crop.h * w) / coords.h);

            $('#jcropId').css({ width: Math.round(data.Crop.w * w) + 'px', height: Math.round(data.Crop.h * w) + 'px' });
        }

         
        
        $('#preview').css({
            width: Math.round(rx * <?php echo $width ?>) + 'px',
            height: Math.round(ry * <?php echo $height ?>) + 'px',
            marginLeft: '-' + Math.round(rx * coords.x) + 'px',
            marginTop: '-' + Math.round(ry * coords.y) + 'px'
        });
    };
    
    function changeScope(typeId, coords) {       
        
//        for(key in crops) {            
//            if(crops[key].CropType.id == cropType) {
//                data = crops[key];
//            }
//        }
//        if(data.Crop.w != coords.w || data.Crop.h != coords.h || data.Crop.x != coords.x || data.Crop.y != coords.y) {
//            console.debug('xxx');
//        }
        
        api.destroy();
        for(key in crops) {            
            if(crops[key].CropType.id == typeId) {
                data = crops[key];
            }
        }
        cropType = typeId;
        jQuery('#active').attr('value', data.CropType.id);
        
        api = $.Jcrop('#jcrop',{
            setSelect: [data.Crop.x, data.Crop.y, data.Crop.x + data.Crop.w, data.Crop.y + data.Crop.h],
            aspectRatio: data.CropType.ratio,
            allowSelect: true,
            allowResize: true,
            onSelect: updateFeields,
            disable: true,
            onChange: showPreview,
            bgOpacity: .7
        
        });
    }
    
    function reload(id) {
        $.ajax({
            url: '<?php echo $this->Html->url(array('controller' => 'photos', 'action' => 'reload', 'plugin' => 'photo', 'admin' => true, $parentModel)); ?>',
            dataType: 'html',
            type: 'post',
            data: {data: {id: id}},
            success: function(data) {
                $('#PhotoBox-'+id).html(data);
            }
        });        
    }
    
</script>
<?php echo $this->Js->writeBuffer(); ?>