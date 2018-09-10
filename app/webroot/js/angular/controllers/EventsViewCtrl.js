/* 
 * Kontroler wydarzeń w kalendarzu
 */

app.controller('EventsViewCtrl', function($scope, $location, $http) {
    
    
    /*
     * konwersja obiektu daty na string
     */
    $scope.dateToString = function(date){
        month = date.getMonth() + 1;
        day = date.getDate();
        
        if(month.toString().length === 1){
            month = '0' + month.toString();
        }
        
        if(day.toString().length === 1){
            day = '0' + day.toString();
        }
        
        return date.getFullYear() + '-' + month + '-' + day;
    };
    
    /*
     * Pobieranie klasy tła wydarzenia na podstawie jego typu
     */
    $scope.getBgClass = function(event_type_id){
        
        switch(event_type_id) {
            case '-2':
                bgClass = 'bg-blue-chambray';    
                break;
            case '-1':
                bgClass = 'bg-green-turquoise';    
                break;
            case '0':
                bgClass = 'bg-grey';    
                break;
            case '1':
                bgClass = 'bg-yellow'; 
                break;
            case '2':
                bgClass = 'bg-green'; 
                break;
            case '3':
                bgClass = 'bg-purple'; 
                break;    
            default:
                bgClass = 'bg-grey';
        } 
        
        return bgClass;
    };
    
     /*
     * Pobieranie ikony symbolizującej typ danego wydarzenia
     */
    $scope.getEventTypeIcon = function(event_type_id){
        
        switch(event_type_id) {
            case '-2':
                bgClass = 'fa-coffee';    
                break;
            case '-1':
                bgClass = 'fa-flag-checkered';    
                break;
            case '0':
                bgClass = 'fa-circle-o';    
                break;
            case '1':
                bgClass = 'fa-ambulance'; 
                break;
            case '2':
                bgClass = 'fa-flag'; 
                break;
            case '3':
                bgClass = 'fa-graduation-cap'; 
                break;    
            default:
                bgClass = 'fa-circle-o';
        } 
        
        return bgClass;
    };
    
    $scope.getCalendar = function(calendar_id,profile_id) {
        $http.post('/calendars/view.json', {calendar_id: calendar_id, profile_id: profile_id}).success(function(data) {         
            $scope.calendar = data.calendar;
            $scope.year = data.calendar.Calendar.year;
            
            allEvents = $scope.prepareAllEvents(data.eventsDefined, data.vacations, data.calendar.Event, data.calendar.Calendar.year);
            
            $scope.renderCalendar(data.calendar.Calendar.year, allEvents);
        });
    };
    
    /*
     * Przygotowuje wydarzenia do wyświetlenia na kalendarzu
     * Wydarzenia zdefiniowane + wydarzenia z bazy danych zapisane przez użytkowników
     */
    $scope.prepareAllEvents = function(eventsDefined, vacations, events, year){

        allEvents = events.slice(0);
        
        angular.forEach(eventsDefined, function(eventDefined) {
            
            if(eventDefined.EventDefined.day.length == 1){
                day = '0' + eventDefined.EventDefined.day;
            } else {
                day = eventDefined.EventDefined.day;
            }
            
            if(eventDefined.EventDefined.month.length == 1){
                month = '0' + eventDefined.EventDefined.month;
            } else {
                month = eventDefined.EventDefined.month;
            }

            newEvent = {
                start: year + '-' + month + '-' + day,
                end: year + '-' + month + '-' + day,
                title: eventDefined.EventDefined.title,
                event_type_id: '-1',
            }
            
            allEvents.push(newEvent);
        });
       
       angular.forEach(vacations, function(vacation) {           
            dateEnd = new Date(vacation.Vacation.date_end.toString());            
            dateEnd.setDate(dateEnd.getDate() + 1);

            newEvent = {
                start: vacation.Vacation.date_start,
                end: $scope.dateToString(dateEnd),
                title: 'Urlop: ' + vacation.Profile.firstname + ' ' + vacation.Profile.surname,
                event_type_id: '-2',
            }
            
            allEvents.push(newEvent);
        });
        
        return allEvents;
    };
    
    
    $scope.renderCalendar = function(year, events){
        
        currentYear = new Date().getFullYear();
        if(currentYear == year){
            month = new Date().getMonth() + 1;
            month = month.toString();
            
            if(month.length == 1){
                month = '0' + month;
            }
        } else {
            month = '01';
        }
        
        $(document).ready(function () {  

            $('#calendar').fullCalendar({
                header: {
                    left: 'title',
                    right: 'prev,next'
                },
                defaultDate: year + '-' + month + '-01',
                lang: 'pl',
                editable: false,
                droppable: false,
    
                eventRender: function(event, element) {
                    element.addClass($scope.getBgClass(event.event_type_id));
                    
                    element.append( "<i class='fa " + $scope.getEventTypeIcon(event.event_type_id) + " event-type-icon'></i>");  
                    
                    fcTitleContainer = element.find('.fc-title');
                    fcTitleContainer.attr('title', event.title);
                    fcTitleContainer.attr('data-placement', 'top');
                    fcTitleContainer.attr('data-toggle', 'tooltip');
                    $('[data-toggle="tooltip"]').tooltip();
                },
                
                eventAfterAllRender: function(view){
                    title = $('#calendar .fc-left h2').text();

                    if(title == 'Styczeń ' + year){
                        $('#calendar .fc-prev-button').hide();
                        return false;
                    } else if(title == 'Grudzień ' + year){
                        $('#calendar .fc-next-button').hide();
                        return false;
                    } else {
                        $('#calendar .fc-next-button').show();
                        $('#calendar .fc-prev-button').show();
                    }
                    
                    $('[data-toggle="tooltip"]').tooltip();        
                },
                
                events: events,

            });    
        });   
    }

});