<?php

App::uses('AppModel', 'Model');

/**
 * Cron Model
 *
 */
class Cron extends AppModel
{

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';

    /**
     * Domyślne sortowanie
     *
     * @var string
     */
    public $order = 'Cron.created DESC';

    /**
     * Callback wykonywany przed walidajcją
     * 
     * @param type $options 
     */
    public function beforeValidate($options = array())
    {
        $this->validate = array(
            'url' => array(
                'notempty' => array(
                    'rule' => array('notempty'),
                    'message' => __d('validate', 'Pole formularza nie może być puste'),
                ),
            ),
        );
    }

    public function check($data)
    {
        $N = date('N'); //dni tygodnia
        $m = date('m'); //miesiąc
        $d = date('d'); //dzien
        $H = date('H'); //godzina
        $i = date('i'); //minuta
        $NB = explode(',', $data['N']); //dni tygodnia
        $mB = explode(',', $data['m']); //miesiąc
        $dB = explode(',', $data['d']); //dzien
        $HB = explode(',', $data['H']); //godzina
        $iB = explode(',', $data['i']); //minuta

        $NC = ($data['N'] == '*' || empty($data['N']) || in_array($N, $NB));
        $mC = ($data['m'] == '*' || empty($data['m']) || in_array($m, $mB));
        $dC = ($data['d'] == '*' || empty($data['d']) || in_array($d, $dB));
        $HC = ($data['H'] == '*' || empty($data['H']) || in_array($H, $HB));
        $iC = ($data['i'] == '*' || empty($data['i']) || in_array($i, $iB));
        //jezeli jest ustawiony dzien tygodnia
        //to sprawdza dnia dzień

        return ($NC && $mC && $dC && $HC && $iC);
    }

}
