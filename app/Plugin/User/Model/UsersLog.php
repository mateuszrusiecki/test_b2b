<?php

class UsersLog extends AppModel
{

    public $name = 'UsersLog';
    public $tablePrefix = 'user_';
    public $useTable = 'users_logs';
    public $belongsTo = array(
        'User' => array(
            'className' => 'User.User',
            'foreignKey' => 'user_id',
            'conditions' => '',
            'fields' => ''
        )
    );

    function beforeSave($options = array())
    {

        if (empty($this->data['UsersLog']['id']) AND empty($this->id))
        {

            $this->data['UsersLog']['really_ip'] = $this->getOnlyIP();
            $this->data['UsersLog']['users_ip'] = $this->getUserIP();
            if (empty($this->data['UsersLog']['action']))
            {
                $this->data['UsersLog']['action'] = $_SERVER['PHP_SELF'];
            }
        }

        return true;
    }

    /**
     * Funkcja zwraca IP uzytkownika, serwera PROXY i host
     * 
     * @return string 
     */
    function getUserIP()
    {
        $userIP = '';

        // Uzytkownik wchodzi poprzez PROXY
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $userIP .= 'IP:' . $_SERVER['HTTP_X_FORWARDED_FOR'] . ', PROXY:' . $_SERVER['REMOTE_ADDR'] . ', HOST: ' . @gethostbyaddr($_SERVER['HTTP_X_FORWARDED_FOR']);
        } else
        {
            // Uzytkownik wszedl bez serwera PROXY
            $userIP .= 'IP:' . $_SERVER['REMOTE_ADDR'] . ', HOST: ' . @gethostbyaddr($_SERVER['REMOTE_ADDR']);
        }

        return $userIP;
    }

    /**
     * Funkcja zwraca rzeczywiste (z uwzglednieniem PROXY) IP uzytkownika
     * 
     * @return type 
     */
    function getOnlyIP()
    {
        $userIP = null;

        if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        {
            $userIP = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else
        {
            // if access direct to Internet, without Proxy
            $userIP = $_SERVER['REMOTE_ADDR'];
        }

        return $userIP;
    }

    function last_login($user_id)
    {
        $this->recursive = -1;
        $data = $this->find('all', array(
            'conditions' => array(
                'UsersLog.user_id' => $user_id,
                'UsersLog.action' => 'Zalogowano poprawnie'
            ),
            'order' => 'UsersLog.created DESC',
            'limit' => 2,
            'fields' => 'created'
        ));

        if (!isset($data[1]))
        {
            $data = 'pierwsze logowanie';
        } else
        {
            $data = $data[1]['UsersLog']['created'];
            $date = new DateTime($data);
            $data = $date->format('d-m-Y H:i:s');
        }

        return $data;
    }

    /*
     * metoda sprawdzająca czy nieudana próba logowania z danego ip powtórzyła się przynajmniej 10 razy w ciągu 10 minut
     * jeśli tak to wysyłany jest emial do administratora
     */

    function checkIf10LoginAttemptsFailed()
    {
        $date = date('Y-m-d H:i:s');
        $currentDate = strtotime($date);
        $pastDate = $currentDate - (60 * 10);
        $formatedPastDate = date("Y-m-d H:i:s", $pastDate);

        //wyszukuje wszystkie niedane próby logowania z ostatnich 10minut
        $params = array(
            'conditions' => array(
                'UsersLog.users_ip' => $this->getUserIP(),
                'UsersLog.action' => 'Nieprawodłowy login lub hasło',
                'UsersLog.created > ' => $formatedPastDate
            )
        );
        $all_user_logs = $this->find('all', $params);
        //die(debug($all_user_logs));
        if (count($all_user_logs) >= 10)
        {
            App::uses('FebEmail', 'Lib');
            $email = new FebEmail('smtp');
            $email->viewVars(array('value' => $all_user_logs));

            $email->template('suspicious_login')
                    ->emailFormat('html')
                    ->to('admin@feb.net.pl')
                    ->bcc("test_dev@febdev.pl")
                    ->from(array('crm@febdev.pl' => 'Fabryka e-biznesu'))
                    ->subject(__d('email', 'Podejrzane logowanie'));
            $email->send();
            $email->reset();
        }
    }

    function parse2List($array = array(), $model = null, $types = null)
    {
        $type = '';
        $name = '';
        foreach ($array as $data)
        {
            if ($model == 'UsersLog')
            {
                $name = $data[$model]['users_ip'];
                $type = $data[$model]['action'];
                $user = empty($data[$model]['email']) ? $data['User']['email'] : $data[$model]['email'];
            } else
            {
                $name = $data[$model]['name'];
                $user = $data['Profile']['firstname'];
                $user .= ' ' . $data['Profile']['surname'];
            }
            if (!empty($types))
            {
                $type = empty($types[$data[$model]['type_log_id']]) ? '' : $types[$data[$model]['type_log_id']];
            }
            $date = $data[$model]['created'];
            $return[] = array(
                'name' => empty($name) ? '' : $name,
                'user' => $user,
                'date' => $date,
                'type' => $type,
                'model' => $model
            );
        }
        return $return;
    }

}

?>
