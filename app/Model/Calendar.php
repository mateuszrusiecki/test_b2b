<?php

App::uses('AppModel', 'Model');

/**
 * Calendar Model
 */
class Calendar extends AppModel
{
    
    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasMany = array(
        'Event' => array(
            'className' => 'Event',
            'foreignKey' => 'calendar_id',
            'fields' => array(
                'Event.event_type_id',
                'Event.title',
                'Event.start',
                'Event.end',
                'Event.event_id',
                'Event.profiles',
            ),
            'order' => 'Event.date_start'
        )
    );
    
    public $recursive = 2;
    
    /**
     * Callback wykonywany przed walidajcją
     * 
     * @param type $options 
     */
    public function beforeValidate($options = array())
    {
        $this->validate = array(
            'year' => array(
                'required' => array(
                    'rule' => 'notEmpty',
                    'message' => __d('validate', 'Rok wymagany'),
                )
            ), 
            'name' => array(
                'required' => array(
                    'rule' => 'notEmpty',
                    'message' => __d('validate', 'Nazwa wymagana'),
                )
            )
        );
    }
    
    /*
     * Zwraca kalendarz w kontekście danego profilu
     */
    public function getProfilesCalendar($calendar_id = null, $profile_id = null){
        
        $this->hasMany['Event']['conditions'] = array(
            'or' => array(
                'or' => array(
                    'and' => array(
                        'Event.event_type_id' => '2',
                        'Event.profiles' => '[]', 
                    ),
                    'and' => array(
                        'Event.event_type_id' => '2',
                        'Event.profiles' => '', 
                    ),
                ),
                'Event.profiles LIKE' => '%"' . $profile_id . '"%',
            )
        );
        
        return $this->findById($calendar_id);
    }
	
	
    /*
     * Zwraca kalendarz w kontekście danego profilu
     */
    public function getEventsWithEmptyProfiles($calendar_id = null){
        
        $this->hasMany['Event']['conditions'] = array('Event.profiles' => null);
        
        return $this->findById($calendar_id);
    }
    
    /**
     * Lista wszystkich kalendarzy
     * 
     * @return array        lista kalendarzy
     */
    public function getCalendars(){
        
        return $this->find('all', array(
            'fields' => array('Calendar.year', 'Calendar.name', 'Calendar.id'),
            'order' => 'Calendar.year DESC',
        ));
    }
    
    /**
     * Lista zatwierdzonych przez sekretariat wniosków urlopowych
     * 
     * @return array        lista wniosków urlopowych
     */
    public function getApprovedVacations($profile_id = null){
        
        $vacation = ClassRegistry::init('Vacation');
        
        $vacation->unbindModel(array('hasMany' => array('VacationReplace'), 'belongsTo' => array('User')));
        
        $conditions = array(
            'Vacation.vacation_status_id' => 4
        );   
        
        if($profile_id !== null){
            $profileModel = ClassRegistry::init('Profile');
            $profile = $profileModel->findById($profile_id);
            $conditions['Vacation.user_id'] = $profile['Profile']['user_id'];
        }
        
        return $vacation->find('all', array(
                'conditions' => $conditions,           
                'fields' => array(
                    'User.id',
                    'Vacation.date_start',
                    'Vacation.date_end',
                    'Vacation.vacation_status_id',
                    'Profile.firstname',
                    'Profile.surname',
                ),
                'joins' => array(     
                    array(
                        'table' => 'user_users',
                        'alias' => 'User',
                        'type' => 'LEFT',
                        'conditions' => array(
                            'Vacation.user_id = User.id',
                        )
                    ),
//                    array(
//                        'table' => 'profiles',
//                        'alias' => 'Profile',
//                        'type' => 'LEFT',
//                        'conditions' => array(
//                            'Profile.user_id = User.id',
//                        )
//                    )
                ),
            )
        );
    }
}