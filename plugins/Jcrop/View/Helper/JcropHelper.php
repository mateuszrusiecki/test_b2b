<?php
/**
 * CakePHP Jcrop Plugin
 *

 *
 * @copyright 2011 - 2011, Cake Development Corporation (http://cakedc.com)
 * @link      http//feb.net.pl
 * @package   plugins.jcrop
 * @license   FEB
 */

/**
 * Short description for class.
 *
 * @package  plugins.jcrop.views.helpers
 */
class JcropHelper extends AppHelper {

    /**
     * Other helpers used by FormHelper
     *
     * @var array
     * @access public
     */
    public $helpers = array('Html', 'Js');

    public function init() {
        ?>

        <div id="editCrop"></div>

        <script type="text/javascript">
            function editCrop(childModel, field, id, parentModel){
                $.ajax({
                    url: '<?php echo $this->Html->url(array('controller' => 'jcrops', 'action' => 'edit', 'plugin' => 'jcrop', 'admin' => false)); ?>',
                    dataType: 'html',
                    type: 'post',
                    data: {data: {childModel: childModel, field: field, id: id, parentModel: parentModel}},
                    success: function(data) {
                        $("#editCrop").html(data);
                        openCrop();
                    }
                });
            }
            function openCrop() {
                jQuery("#editCrop").dialog('open');                
                        
            }
            jQuery("#editCrop").dialog({width: 800, height: 600}).dialog('close');
        </script>
    <?php
    }

    /**
     * beforeRender callback
     *
     * @return void
     * @access public
     */
    public function beforeRender() {
        $this->Html->script('/jcrop/js/jquery.Jcrop.min', array('inline' => false));
        $this->Html->css('/jcrop/css/jquery.Jcrop', null, array('inline' => false));
        $this->Html->css('/jcrop/css/jcrop', null, array('inline' => false));
    }

}
?>

