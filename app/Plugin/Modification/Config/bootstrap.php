<?php


/**
 * Konfiguracja pluginu photo
 */
App::uses('CakeEventManager', 'Event');
CakeEventManager::instance()->attach('beforeRenderDetalis', 'Helper.Modification.beforeRenderDetalis');

/*
 * Dane dostępne podczas  
 */

function beforeRenderDetalis($event) {
    $modification = $event->data['modification'];
    $message = '';
    $classes = array();

    //Tworze poczatek wiadomosci
    $classes[] = $modification['Modification']['action'];
    
    switch ($modification['Modification']['action']) {
        case 'add':
            $message = __d('modification', "Dodał ");

            break;
        case 'edit':
            $message = __d('modification', "Zmieniał ");

            break;
        case 'delete':
            $message = __d('modification', "Usunął ");

            break;
        case 'softdelete':
            $message = __d('modification', "Bezpiecznie usunął ");

            break;
        case 'undelete':
            $message = __d('modification', "Przywrócił ");

            break;
        default:
            $message = __d('modification', "Niezidentyfikowany typ akcji! {$modification['Modification']['action']}");
            break;
    }
    
    switch ($modification['Modification']['model']) {
        case 'SportingEventResult':           
            $message .= __d('modification', "wyniki z zawodów, <b>%s</b>", $modification['Modification']['After']['name']);
            break;
        case 'SportingEvent':
            $message .= __d('modification', "zawody sportowe, <b>%s</b>", @$modification['Modification']['After']['name']);
             break;
        case 'Competition':
            $message .= __d('modification', "konkurencję, <b>%s</b>", @$modification['Modification']['After']['name']);
             break;
         
        case 'Sport':
            $message .= __d('modification', "sport, <b>%s</b>", @$modification['Modification']['After']['name']);
             break;
         
        case 'Discipline':
            $message .= __d('modification', "dyscyplinę, <b>%s</b>", @$modification['Modification']['After']['name']);
             break;
         
        case 'TrainingClass':
            $message .= __d('modification', "klasę trenerską, <b>%s</b>", @$modification['Modification']['After']['name']);
             break;
         
        case 'OlympicQualification':
            $message .= __d('modification', "kwalifikację olimpijską");
             break;
        case 'SportingEventsGrade':
            $message .= __d('modification', "rangę zawodów sportowych, <b>%s</b>", @$modification['Modification']['After']['name']);
             break;
        case 'PolishSportsAssociation':
            $message .= __d('modification', "polski związek spotowy, <b>%s</b>", @$modification['Modification']['After']['name']);
             break;
        case 'Club':
            $message .= __d('modification', "klub sportowy, <b>%s</b>", @$modification['Modification']['After']['name']);
             break;
        case 'ActionType':
            $message .= __d('modification', "typ akcji, <b>%s</b>", @$modification['Modification']['After']['name']);
            break;
        case 'Schedule':
            $message .= __d('modification', "łączkę");
            break;
        default:
            $message = __d('modification', "niezdefiniowany komunikat dla, <b>%s</b>", @$modification['Modification']['model']);
            break;
    }
    $event->result['message'] = str_replace(', <b>%s</b>', '.', $message);
    $event->result['classes'] = implode(' ', $classes);
    
}

?>