<?php
App::uses('AppModel', 'Model');
/**
 * SheduleAgreementPosition Model
 *
 * @property ProjectSheduleAgreement $ProjectSheduleAgreement
 */
class SheduleAgreementPosition extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'title';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ProjectSheduleAgreement' => array(
			'className' => 'ProjectSheduleAgreement',
			'foreignKey' => 'project_shedule_agreement_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
