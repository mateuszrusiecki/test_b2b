<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Errors
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<h2><?php echo __d('cake_dev', 'Database Error'); ?></h2>
<p class="error">
	<strong><?php echo __d('cake_dev', 'Error'); ?>: </strong>
	<?php echo h($error->getMessage()); ?>
</p>
<?php if (!empty($error->queryString)) : ?>
	<p class="notice">
		<strong><?php echo __d('cake_dev', 'SQL Query'); ?>: </strong>
        <?php $tab = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'?>
        <?php echo str_replace(
                array(',', 'SELECT','LEFT JOIN', 'FROM', 'ON', 'WHERE', 'LIMIT', 'GROUP BY', 'ORDER BY'), 
                array(
                    "<br/>{$tab},",
                    "<br/><b>SELECT</b><br/>&nbsp{$tab}",
                    "<br /><br /><b>LEFT JOIN</b><br />{$tab}", 
                    "<br /><br /><b>FROM</b><br />{$tab}", 
                    "<br /><b><i>ON</i></b><br/>{$tab}", 
                    "<br /><b>WHERE</b><br/>{$tab}", 
                    "<br /><b>LIMIT</b><br/>{$tab}", 
                    "<br /><b>GROUP BY</b><br/>{$tab}", 
                    "<br /><b>ORDER BY</b><br/>{$tab}"), 
                $error->queryString); ?>
	</p>
<?php endif; ?>
<?php if (!empty($error->params)) : ?>
		<strong><?php echo __d('cake_dev', 'SQL Query Params'); ?>: </strong>
		<?php echo  Debugger::dump($error->params); ?>
<?php endif; ?>
<p class="notice">
	<strong><?php echo __d('cake_dev', 'Notice'); ?>: </strong>
	<?php echo __d('cake_dev', 'If you want to customize this error message, create %s', APP_DIR . DS . 'View' . DS . 'Errors' . DS . 'pdo_error.ctp'); ?>
</p>
<?php echo $this->element('exception_stack_trace'); ?>
