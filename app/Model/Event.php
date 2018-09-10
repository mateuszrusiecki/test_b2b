<?php

App::uses('AppModel', 'Model');

/**
 * Event Model
 */
class Event extends AppModel
{

    public $virtualFields = array(
        'event_id' => 'id',
        'start' => 'date_start',
        'end' => 'date_end',
    );
    public $belongsTo = array(
        'EventType' => array(
            'className' => 'EventType',
            'foreignKey' => 'event_type_id',
        )
    );

    /*
     * Konwersja dnia z liczby na string
     * 
     * @param int $day         dzień
     * 
     * $return string          dzień
     */

    public function convertDayToString($day)
    {

        if (strlen((string) $day) == 1)
        {
            return '0' . (string) $day;
        } else
        {
            return (string) $day;
        }
    }

    /*
     * Konwersja miesiąca z liczby na string
     * 
     * @param int $month         miesiac
     * 
     * $return string            miesiac
     */

    public function convertMonthToString($month)
    {

        if (strlen((string) $month) == 1)
        {
            return '0' . (string) $month;
        } else
        {
            return (string) $month;
        }
    }

    /*
     * Zwraca kolejny miesiąc w stringu na podstawie aktualnego miesiąca
     * 
     * @param int $month         miesiac
     * 
     * $return string            kolejny miesiac
     */

    public function getNextMonth($month)
    {

        $nextMonth = $month + 1;

        if ($nextMonth == 13)
        {
            $nextMonth = 1;
        }

        if (strlen((string) $nextMonth) == 1)
        {
            return '0' . (string) $nextMonth;
        } else
        {
            return (string) $nextMonth;
        }
    }

    /*
     * Funkcja zwraca wolne dni w danym miesiącu danego roku
     * UWZGLĘDNIA WYDARZENIA TYPU "DZIEN WOLNY" DODAWANE PRZEZ PRACOWNIKOW SEKRETARIATU
     * 
     * @return int $month            miesiąc
     * @return int $year             rok
     * 
     * @return array                 tablica dat dni wolnych w danym miesiacu
     */

    public function getMonthFreeDaysDatesEvents($month, $year)
    {

        $month = $this->convertMonthToString($month);
        $nextMonth = $this->getNextMonth($month);

        if ($nextMonth == '01')
        {
            $year++;
        }

        $thisMonthFreeDays = $this->find('all', array(
            'conditions' => array(
                'or' => array(
                    'and' => array(
                        'Event.date_start <' => $year . '-' . $nextMonth . '-01',
                        'Event.date_start LIKE' => '%-' . $month . '-%',
                    ),
                    'and' => array(
                        'Event.date_end >' => $year . '-' . $month . '-01',
                        'Event.date_end LIKE' => '%-' . $month . '-%',
                    ),
                ),
                'Event.event_type_id' => 2
            ),
            'fields' => array(
                'Event.date_start',
                'Event.date_end'
            ),
            'recursive' => -1
                )
        );

        $dates = array();

        for ($i = 0; $i < sizeof($thisMonthFreeDays); $i++)
        {

            $dateStart = new DateTime($thisMonthFreeDays[$i]['Event']['date_start']);
            $dateEnd = new DateTime($thisMonthFreeDays[$i]['Event']['date_end']);

            while ($dateStart < $dateEnd)
            {

                if ($dateStart->format('m') == $month)
                {
                    $dates[] = $dateStart->format('Y-m-d');
                } else
                {
                    break;
                }

                $dateStart->add(new DateInterval('P1D'));
            }
        }

        return array_unique($dates);
    }

    /*
     * Funkcja zwraca wolne dni w danym miesiącu danego roku
     * UWZGLĘDNIA ŚWIĘTA ZDEFINIOWANE: EVENTS DEFINED Z TABELI events_defined
     * 
     * @return int $month            miesiąc
     * @return int $year             rok
     * 
     * @return array                 tablica dat dni wolnych w danym miesiacu
     */

    public function getMonthFreeDaysDatesEventsDefined($month, $year)
    {

        $eventDefined = ClassRegistry::init('EventDefined');

        $eventsDefined = $eventDefined->find('all', array(
            'conditions' => array(
                'month' => $month,
            ),
            'fields' => array(
                'day'
            )
                )
        );

        $dates = array();

        $month = $this->convertMonthToString($month);

        foreach ($eventsDefined as $eventDefined)
        {

            $day = $this->convertDayToString($eventDefined['EventDefined']['day']);
            $dates[] = $year . '-' . $month . '-' . $day;
        }

        return $dates;
    }

    /**
     * Funkcja zwraca daty weekendów danego weekendu danego roku
     * 
     * @param type $monthc           miesiąc
     * @param type $year             rok   
     * 
     * @return array                 tablica weekendów w danym miesiącu w danym roku
     */
    public function getMonthFreeDaysWeekends($month, $year)
    {

        $dates = array();

        $month = $this->convertMonthToString($month);

        $date = new DateTime($year . '-' . $month . '-01');

        while ($date->format('m') == $month)
        {

            if ($date->format('w') == 0 || $date->format('w') == 6)
            {

                $dates[] = $date->format('Y-m-d');
            }

            $date->add(new DateInterval('P1D'));
        }

        return $dates;
    }

    /*
     * Funkcja zwraca WSZYSTKIE dni w danym miesiącu danego roku
     * UWZGLĘDNIA ŚWIĘTA ZDEFINIOWANE, WEEKENDY ORAZ DNI WOLNE WPROWADZONE W KALENDARZU
     * 
     * @return int $month            miesiąc
     * @return int $year             rok
     * 
     * @return array                 tablica dat dni wolnych w danym miesiacu
     */

    public function getMonthFreeDaysDates($month, $year)
    {

        $datesEvents = $this->getMonthFreeDaysDatesEvents($month, $year);
        $datesEventsDefined = $this->getMonthFreeDaysDatesEventsDefined($month, $year);
        $datesWeekends = $this->getMonthFreeDaysWeekends($month, $year);

        return array_unique(array_merge($datesEventsDefined, $datesEvents, $datesWeekends));
    }

    /*
     * Zwraca liczbę dni pracujących w danym miesiącu na podstawie kalendarza
     * UWZGLĘDNIA ŚWIĘTA ZDEFINIOWANE, WEEKENDY ORAZ DNI WOLNE WPROWADZONE W KALENDARZU
     * 
     * @return int $month            miesiąc
     * @return int $year             rok
     * 
     * @return int                   liczba dni pracujących w danym miesiącu
     */

    public function getMonthWorkingDays($month, $year)
    {

        $freeDaysCount = count($this->getMonthFreeDaysDates($month, $year));

        return cal_days_in_month(CAL_GREGORIAN, $month, $year) - $freeDaysCount;
    }

    /*
     * Zwraca wszystkie eventy danego uzytkownika
     * 
     * @return int $profile_id            Id Profil
     * 
     * @return array                   tablica ewentów
     */

    public function getEventForProfile($profile_id=null, $event_type_id=null)
    {
        if (empty($profile_id))
        {
            return false;
        }
        if (!empty($event_type_id))
        {
            $params['conditions']['Event.event_type_id'] = $event_type_id;
        }
        $params['recursive'] = -1;
        $params['conditions']['Event.profiles LIKE'] = '%"' . $profile_id . '"%';
        $event = $this->find('all', $params);
        return empty($event) ? false : HASH::combine($event, '{n}.Event.id', '{n}.Event');
    }

}
