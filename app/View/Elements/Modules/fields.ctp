<?php
echo $this->Metronic->input('name', array('label' => __d('cms', 'Name')));
echo $this->Metronic->input('module_category_id', array('ng-model' => 'category_id', 'empty' => 'dodaj nową', 'label' => __d('cms', 'Module Category Id')));
echo $this->Metronic->input('module_category', array('div' => array('ng-if' => '!category_id'), 'type' => 'text', 'label' => __d('cms', 'Dodaj categorie')));
echo $this->Metronic->input('desc', array('label' => __d('cms', 'Desc')));
echo $this->Metronic->input('img', array('type' => 'file', 'label' => __d('cms', 'Img')));
echo $this->Metronic->input('lang', array('label' => __d('cms', 'Lang')));
echo $this->Metronic->input('manager_user_id', array('label' => __d('cms', 'Manager User Id')));
echo $this->Metronic->input('contact_user_id', array('label' => __d('cms', 'Contact User Id')));
echo $this->Metronic->input('comments', array('label' => __d('cms', ' Comments')));
echo $this->Metronic->input('rep_type', array('label' => __d('cms', 'Rep Type')));
echo $this->Metronic->input('rep_path', array('label' => __d('cms', 'Rep Path')));
?>
