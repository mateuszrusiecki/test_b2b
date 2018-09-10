<?php
App::uses('AppModel', 'Model');
/**
 * BudgetAgreement Model
 *
 * @property ClientProjectBudget $ClientProjectBudget
 * @property Deparment $Deparment
 * @property AgreementPosition $AgreementPosition
 */
class BudgetAgreement extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ClientProjectBudget' => array(
			'className' => 'ClientProjectBudget',
			'foreignKey' => 'client_project_budget_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Deparment' => array(
			'className' => 'Deparment',
			'foreignKey' => 'deparment_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'AgreementPosition' => array(
			'className' => 'AgreementPosition',
			'foreignKey' => 'budget_agreement_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
