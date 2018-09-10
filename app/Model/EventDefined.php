<?php

App::uses('AppModel', 'Model');

/**
 * EventDefined Model
 */
class EventDefined extends AppModel
{

    public $useTable = 'events_defined';

    /**
     * Parsowanie dat  dni wolnych
     * 
     * @return array        tablica dni wolnych w miesiąc-dzień date(m-d)
     */
    public function parseEventDefined()
    {
        $edparams['fields'] = array('month', 'day');

        $eventsDefineds = $this->find('all', $edparams);
        foreach ($eventsDefineds as $eventsDefined)
        {
            $d = $eventsDefined['EventDefined']['month'] . '-' . $eventsDefined['EventDefined']['day'];
            $eventsDefinedList[$d] = $d;
        }
        return $eventsDefinedList;
    }

}
