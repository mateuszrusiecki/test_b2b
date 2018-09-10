<?php

App::uses('AppModel', 'Model');

/**
 * ClientProjectShedule Model
 *
 * @property ClientProject $ClientProject
 * @property ProjectSheduleAgreement $ProjectSheduleAgreement
 */
class ClientProjectShedule extends AppModel
{
    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'ClientProject' => array(
            'className' => 'ClientProject',
            'foreignKey' => 'client_project_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );

    public function getShedules($project_id = null)
    {
        if (!$this->ClientProject->exists($project_id))
        {
            return false;
        }
        $shedules = $this->find('all', array('recursive' => -1, 'conditions' => array('ClientProjectShedule.client_project_id' => $project_id)));
        //$payments = Hash::combine($payment,'{n}.Payment.id','{n}.Payment');
        if (empty($shedules))
        {
            return array();
        }
        foreach ($shedules as $shedule)
        {
            $return[] = $shedule['ClientProjectShedule'];
        }
        return $return;
    }

    /**
     * Funkcja wyciąga wszystkie wydarzenia oraz parsuje i wylicza cykliczność
     * 
     * @param type $project_id
     * @return arrray
     */
    public function parseTimeLine($project_id = null)
    {
        if (!$this->ClientProject->exists($project_id))
        {
            return false;
        }

        $shedules = $this->getShedules($project_id);
        $timeline = array();
        foreach ($shedules as $data)
        {
            switch ($data['type'])
            {
                case 'cycle':
                    $data['interval'] = (int) empty($data['interval']) ? 1 : $data['interval'];
                    $data['payment_day'] = (int) empty($data['payment_day']) ? 1 : $data['payment_day'];
                    $data['date'] = (int) empty($data['date']) ? date('Y-m-d') : $data['date'];
                    $data['date_to'] = (int) empty($data['date_to']) ? date('Y-m-d') : $data['date_to'];

                    $tmp = strtotime($data['date']);
                    do
                    {
                        $day = date('Y-', $tmp);
                        $day .= date('m-', $tmp);
                        $day .= $data['payment_day'];
                        if (strtotime($day) >= strtotime($data['date']))
                        {
                            $timeline[] = array(
                                'start' => $this->ClientProject->parseTime($day),
                                'end' => null,
                                'content' => $data['name'],
                                'type' => $data['type']
                            );
                        }
                        $tmp = strtotime("+{$data['interval']} month", strtotime($day));
                    } while ($tmp < strtotime($data['date_to']));
                    break;

                default:
                    $timeline[] = array(
                        'start' => $this->ClientProject->parseTime($data['date']),
                        'end' => $this->ClientProject->parseTime($data['date_to']),
                        'content' => $data['name'],
                        'type' => $data['type'],
                        'id' => $data['id'],
                        'done' => $data['done'],
                        'desc' => $data['desc'],
                    );
                    break;
            }
        }
        return $timeline;
    }

    /**
     * Funkcja usuwa wydarzenie
     * 
     * @param type $id		int id wydarzenia
     * @return boolean		true - po usunięciu
     * 						false - w przypadku błędu
     */
    function deleteShedule($id = null)
    {
        if (!$id || empty($id))
        {
            return false;
        }

        return $this->delete($id);
    }

    /**
     * Funkcja zapisuje wydarzenie
     * 
     * @param type $shedule	array dane do zapisu
     * @return boolean		true - po usunięciu
     *                          false - w przypadku błędu
     */
    function saveShedule($shedule = null)
    {
        if (empty($shedule))
        {
            return false;
        }

        return $this->save($shedule);
    }

    /**
     * Funkcja zapisuje wydarzenie
     * 
     * @param type $shedule	array dane do zapisu
     * @return boolean		true - po usunięciu
     *                          false - w przypadku błędu
     */
    public function lastAgreement($project_id = null)
    {
        $params['recursive'] = -1;
        $params['conditions']['client_project_id'] = $project_id;
        $params['conditions']['type'] = 'agreement';
        $params['order'] = 'date_to DESC';
        $lastAgreement = $this->find('first', $params);

        $this->ClientProject->id = $project_id;
        $date_to = $this->ClientProject->field('end_project');

        $timePrjectUP = (!empty($lastAgreement['ClientProjectShedule']['date_to']) && strtotime($date_to) > strtotime($lastAgreement['ClientProjectShedule']['date_to']));
       

        if (empty($lastAgreement) || $timePrjectUP)
        {
            unset($lastAgreement);
            $date = $this->ClientProject->field('start_project');
            $lastAgreement['date'] = $date;
            $lastAgreement['date_to'] = $date_to;
            $lastAgreement['name'] = __d('public', 'Projekt');
            $lastAgreement['desc'] = __d('public', 'Projekt');
            $lastAgreement['client_project_id'] = $project_id;
        } else
        {
            $lastAgreement = $lastAgreement['ClientProjectShedule'];
        }
        return $lastAgreement;
    }

}
