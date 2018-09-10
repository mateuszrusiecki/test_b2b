<?php
App::uses('AppModel', 'Model');
/**
 * AgreementPosition Model
 *
 * @property BudgetAgreement $BudgetAgreement
 * @property Shedule $Shedule
 */
class AgreementPosition extends AppModel {


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'BudgetAgreement' => array(
			'className' => 'BudgetAgreement',
			'foreignKey' => 'budget_agreement_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Shedule' => array(
			'className' => 'Shedule',
			'joinTable' => 'shedule_agreement_positions',
			'foreignKey' => 'agreement_position_id',
			'associationForeignKey' => 'shedule_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
