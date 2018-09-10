<?php

App::uses('AppModel', 'Model');

/**
 * Payment Model
 *
 * @property Agreement $Agreement
 */
class Payment extends AppModel
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

    public function getClientPayments($client_id = null)
    {
        if (!$this->ClientProject->Client->exists($client_id))
        {
            return false;
        }
        $params['recursive'] = 1;
        $params['conditions']['ClientProject.client_id'] = $client_id;
        $return = $this->find('all', $params);
        return $return;
    }

    public function getPayments($project_id = null)
    {

        if (empty($project_id))
        {
            return false;
        }
        if (!$this->ClientProject->exists($project_id))
        {
            return false;
        }

        $payments = $this->find('all', array('recursive' => -1, 'conditions' => array('Payment.client_project_id' => $project_id)));
        //$payments = Hash::combine($payment,'{n}.Payment.id','{n}.Payment');
        if (empty($payments))
        {
            return array();
        }

        foreach ($payments as $payment)
        {
            $return[] = $payment['Payment'];
        }

        return $return;
    }

    public function interval()
    {
        for ($i = 1; $i <= 12; $i++)
        {
            $interval[$i] = $i . ' miesięcy';
        }
        return $interval;
    }

    public function paymentDay()
    {
        $payment_day[1] = 1 . ' dzień miesiąca';
        for ($i = 0; $i <= 30; $i = $i + 5)
        {
            $payment_day[$i] = $i . ' dzień miesiąca';
        }
        unset($payment_day[0]);
        return $payment_day;
    }

    /**
     * Funkcja wyciąga wszystkie wydarzenia oraz parsuje i wylicza cykliczność
     * 
     * @param type $project_id
     * @return arrray
     */
    public function parseTimeLine($project_id = null, $user_permission = null)
    {
        if (!$this->ClientProject->exists($project_id))
        {
            return false;
        }

        $shedules = $this->getPayments($project_id);
        $timeline = array();
        $i = 0;
        foreach ($shedules as $data)
        {
            $name = $data['name'];
            if ($user_permission == 'all' || $user_permission == 'manager')
            {
                $name .= ' (';
                $name .= $data['price'];
                $name .= ' ';
                $name .= (empty($data['currency'])?'zł':$data['currency']);
                $name .= ')';
            }
            switch ($data['type'])
            {
                case 'cycle':
                    $data['id'] = (int) empty($data['id']) ? 1 : $data['id'];
                    $data['payment_done'] = (int) empty($data['payment_done']) ? 0 : $data['payment_done'];
                    $data['interval'] = (int) empty($data['interval']) ? 1 : $data['interval'];
                    $data['payment_day'] = (int) empty($data['payment_day']) ? 1 : $data['payment_day'];
                    $data['date'] = (int) empty($data['date']) ? date('Y-m-d') : $data['date'];
                    $data['date_to'] = (int) empty($data['date_to']) ? date('Y-m-d') : $data['date_to'];
                    $data['cycle_number'] = (int) empty($data['cycle_number']) ? 0 : $data['cycle_number'];

                    $tmp = strtotime($data['date']);
                    do
                    {
                        $day = date('Y-', $tmp);
                        $day .= date('m-', $tmp);
                        $day .= $data['payment_day'];
                        if ($i <= $data['cycle_number'])
                        {
                            $payment_done = 1;
                        } else
                        {
                            $payment_done = 0;
                        }
                        if (strtotime($day) >= strtotime($data['date']))
                        {
                            $timeline[] = array(
                                'start' => $this->ClientProject->parseTime($day),
                                'end' => null,
                                'content' => $name . ' >> ' . $i,
                                'type' => $data['type'],
                                'id' => $data['id'],
                                'done' => $payment_done
                            );
                        }
                        $tmp = strtotime("+{$data['interval']} month", strtotime($day));
                        $i++;
                    } while ($tmp < strtotime($data['date_to']));
                    break;

                default:
                    $timeline[] = array(
                        'start' => $this->ClientProject->parseTime($data['date']),
                        'end' => $this->ClientProject->parseTime($data['date_to']),
                        'content' => $name,
                        'type' => $data['type'],
                        'payment_type' => $data['payment_type'],
                        'id' => $data['id'],
                        'done' => $data['payment_done']
                    );
                    break;
            }
        }
        return $timeline;
    }

}
