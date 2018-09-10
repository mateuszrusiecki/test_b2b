<?php

App::uses('AppController', 'Controller');

/**
 * Modifications Controller
 *
 * @property Modification $Modification
 */
class ModificationsController extends AppController {

    /**
     * Tablica helperów doładowywana do kontrolera
     */
    public $helpers = array('FebTime', 'Modification.FebModification');

    /**
     * Tablica komponentów
     * 
     * @var type array
     */
    public $components = array('Filtering');

    /**
     * Akcja generujaca widok zmian w obrebie systemu
     *
     * @return void
     */
    public function admin_view() {
//        $this->layout = 'admin';
        $this->helpers[] = 'Filter';
        $this->Modification->recursive = -1;

        $actionTypes = array(
            'add' => 'Dodawanie',
            'edit' => 'Edytowanie',
            'delete' => 'Usuwanie',
            'softdelete' => "Bezpieczne usuwanie",
            'undelete' => "Przywracanie"
        );

        $modObjects = array();
        $objects = App::objects('Model');
        foreach ($objects as $modelAlias) {
            $this->loadModel($modelAlias);

            if (isSet($this->$modelAlias->actsAs) && in_array('Modification.Modification', $this->$modelAlias->actsAs)) {
                $modObjects[$modelAlias] = $modelAlias;
            }
        }

        $users = $this->User->find('list');

        $this->filters = array(
            'date_from' => array('param_name' => 'date_from', 'default' => '', 'form' =>
                array('label' => __('od'), 'type' => 'text', 'class' => 'date')),
            'date_to' => array('param_name' => 'date_to', 'default' => '', 'form' =>
                array('label' => __('do'), 'type' => 'text', 'class' => 'date')),
            'action' => array('param_name' => 'akcja', 'default' => '', 'form' =>
                array('label' => __('Typ akcji'), 'options' => $actionTypes, 'empty' => 'wszystkie')),
            'model' => array('param_name' => 'model', 'default' => '', 'form' =>
                array('label' => __('Model'), 'options' => $modObjects, 'empty' => 'wszystkie')),
            'user' => array('param_name' => 'uzytkownik', 'default' => '', 'form' =>
                array('label' => __('Użytkownik'), 'options' => $users, 'empty' => 'wszyscy'))
        );

        $filtersParams = $this->Filtering->getParams();
        $params = $this->Modification->filterParams($this->request->data);

        $params['limit'] = 100;
        $this->paginate = $params;

        $modifications = $this->paginate();
        $modifications = $this->Modification->unSerialize($modifications);


        $this->set('filtersSettings', $this->filters);
        $this->set(compact('modifications', 'filtersParams'));
        $title = 'Log systemowy';
        $subtitle = 'Log systemowy';

        $this->set(compact('title', 'subtitle'));
    }

}
