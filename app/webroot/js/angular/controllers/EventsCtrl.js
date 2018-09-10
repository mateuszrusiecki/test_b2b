/* 
 * Kontroler wydarzeń w kalendarzu
 */

app.controller('EventsCtrl', function($scope, $location, $http) {
    
    calendar_id = $location.absUrl().split('/').pop();
    $scope.calendar_id = calendar_id;
    
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
    
    /*
     * przygotowanie nowego kafelka z wydarzeniem
     */
    $scope.prepareNewElement = function(title, event_id, event_type_id, event_type, start, end, profiles){
        
        bgClass = $scope.getBgClass(event_type_id);
        
        newElement = angular.element('<div class="fc-event btn ' + bgClass + '"></div>');
        
        newElement.append('<div id="title">' +  title + '</div>');
        
        if(event_type_id != 0){        
            newElement.append('<div id="type" event_type_id="' + event_type_id + '">' + event_type + '</div>');
        }
        
        if(start !== null && end !== null){
            
            dateStart = new Date(start);
            dateEnd = new Date(end);
            dateEnd.setDate(dateEnd.getDate() - 1);
            
            if(dateEnd > dateStart){
                newElement.append('<div id="dates">(' + start + ' - ' + $scope.dateToString(dateEnd) + ')</div>');
            } else if(dateStart > 0) {
                newElement.append('<div id="dates">(' + start + ')</div>');
            }
        }
  
        newElement.append('<i class="fa fa-plus large-icon addPeople" event_id=' + event_id + ' title="Dodaj osoby (wybór osoby z listy doda ją do wydarzenia)" data-placement="top" data-toggle="tooltip"></i>');
        newElement.append('<i class="fa fa-close large-icon deleteExternalEvent" event_id=' + event_id + ' title="Usuń wydarzenie" data-placement="top" data-toggle="tooltip"></i>');
        
        if(profiles != ''){  
            profiles = angular.fromJson(profiles);
            
            for (i = 0; i < profiles.length; i++) {
                newElement.append('<div profile_id="' + profiles[i][0] + '" class="person">' + profiles[i][1] + '<i class="fa fa-close" title="Usuń osobę" data-placement="top" data-toggle="tooltip"></i></div>'); 
            }
            
        }
        
        return newElement;
    }

    /*
     * dodawanie nowego kafelka z wydarzeniem
     */
    $scope.addEvent = function(){
        title = angular.element('#event_title').val();
        event_type = angular.element('#event_type option:selected').text();
        event_type_id = angular.element('#event_type option:selected').val();
        
        if(title.length == 0){
            title = "Brak tytułu";
        }
        
        data = {
            title: title,
            event_type_id: event_type_id,
            calendar_id: calendar_id,
        }
        
        $http.post('/calendars/save_event', data).success(function(event_id) {   

            newElement = $scope.prepareNewElement(title, event_id, event_type_id, event_type, null, null, '');

            $scope.makeElementDraggable(newElement, '');

            angular.element('#event_box').append(newElement);
            
            $('[data-toggle="tooltip"]').tooltip(); 
        });

    };
    
    
    $scope.makeElementDraggable = function(element, profiles){
        
        var eventObject = {
            title: $.trim(element.find('#title').text()), 
            event_type_id: element.find('#type').attr('event_type_id'),
            event_id: element.find('i.fa').attr('event_id'),
            profiles: profiles,
        };
          
        element.data('eventObject', eventObject);

        element.draggable({
            zIndex: 999,
            revert: true,
            revertDuration: 0
        });
    }
    
    $scope.renderLeftColumnEvents = function(events){
        angular.element('#event_box').text('');
        
        angular.forEach(events, function(event) {
            newElement = $scope.prepareNewElement(event.title, event.event_id, event.event_type_id, event.EventType.name, event.start, event.end, event.profiles);

            $scope.makeElementDraggable(newElement, event.profiles);

            angular.element('#event_box').append(newElement);
        });
        
        $('[data-toggle="tooltip"]').tooltip(); 
    };
    
    $scope.getCalendar = function() {
        
        $http.post('/calendars/edit.json', {calendar_id: calendar_id}).success(function(data) {         
            $scope.calendar = data.calendar;
            $scope.year = data.calendar.Calendar.year;
            
            allEvents = $scope.prepareAllEvents(data.eventsDefined, data.vacations, data.calendar.Event, data.calendar.Calendar.year);
            
            $scope.renderCalendar(data.calendar.Calendar.year, allEvents);

            $scope.renderLeftColumnEvents(data.calendar.Event);
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
                editable: true,
                droppable: true,

                drop: function(date) {    
                    
                    var originalEventObject = $(this).data('eventObject');

                    var copiedEventObject = $.extend({}, originalEventObject);
                    
                    copiedEventObject.start = date;
                    
                    dateStart = date;
                    dateEnd = new Date(date);
                    dateEnd.setDate(dateEnd.getDate() + 1);
                    
                    if($scope.checkIfClientEventExists(copiedEventObject.event_id)){
                                                        
                        $scope.duplicateEvent(copiedEventObject.event_id, dateStart, dateEnd, copiedEventObject, year);
                        
                    } else {    
                        
                        $scope.updateEventsDate(copiedEventObject.event_id, dateStart, dateEnd, year);
                        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                    }                  
                    
                    angular.element('.add-people-form').hide();          
                },           

                eventRender: function(event, element) {
                    element.addClass($scope.getBgClass(event.event_type_id));
                    if(event.event_type_id != -1 && event.event_type_id != -2){
                        element.append( "<i class='fa fa-close deleteEventButton' title='Usuń wydarzenie' data-placement='top' data-toggle='tooltip'></i>");
                        element.append( "<i class='fa fa-angle-right resizeEventButton' title='Po złapaniu za krawędź można rozciągnąć na kolejne dni' data-placement='top' data-toggle='tooltip'></i>");
                        //$('[data-toggle="tooltip"]').tooltip(); 
                    } else {
                        event.editable = false;
                    }
                    
                    element.append( "<i class='fa " + $scope.getEventTypeIcon(event.event_type_id) + " event-type-icon'></i>");
                        
                    element.find(".deleteEventButton").click(function() {
                        $('.deleteEventModal').click();
                        $('.deleteEventModal').attr('eventId', event._id);
                    });
                    
                    fcTitleContainer = element.find('.fc-title');
                    fcTitleContainer.attr('title', event.title);
                    fcTitleContainer.attr('data-placement', 'top');
                    fcTitleContainer.attr('data-toggle', 'tooltip');
                    $('[data-toggle="tooltip"]').tooltip();
                },

                eventResize: function(event){
                    dateStart = new Date(event.start._d);     
                    dateEnd = new Date(event.end._d);
                    
                    $scope.updateEventsDate(event.event_id, dateStart, dateEnd, year);
                    $scope.refreshLeftColumnEvents();
                },
                        
                eventDrop: function(event, delta){
                    dateStart = new Date(event.start._d);     
                    dateEnd = new Date(event.end._d);
                    
                    $scope.updateEventsDate(event.event_id, dateStart, dateEnd, year);
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
                      
            $(document).on("click", "#delete_calendar_event #modalSubmit", function() {              
                id = $('.deleteEventModal').attr('eventId');            
                $scope.deleteEventAndRefreshLeftColumn($scope.getEventIdByClientId(id), $scope.year);
                $('#calendar').fullCalendar('removeEvents', id); 
            });

            $(document).on("click", "#event_box .fc-event .addPeople", function() {
                $scope.addPeople($(this).parent().find('#title').text(), $(this).attr('event_id'));
            });
            
            $(document).on("change", ".add-people-form #profile", function() {
                $scope.addPerson();               
            });
            
            $(document).on("click", ".deleteExternalEvent", function() {
                $('.deleteExternalEventModal').click();
                $('#delete_external_event #modalSubmit').attr('event_id', $(this).attr('event_id'));
            });
            
            $(document).on("click", "#delete_external_event #modalSubmit", function() {
                event_id = $(this).attr('event_id');
                $scope.deleteEventAndRefreshLeftColumn(event_id, $scope.year);
                $('#calendar').fullCalendar('removeEvents', $scope.getClientIdByEventId(event_id)); 
            });
            
            $(document).on("click", "#event_box .fc-event .person i", function() {
                event_id = $(this).parent().parent().find('.deleteExternalEvent').attr('event_id');
                $(this).parent().remove();
                $scope.removePerson(event_id);
            });
            
        });   
    }
    
    $scope.getClientEventById = function(event_id){
        events = $('#calendar').fullCalendar('clientEvents');
        
        for (var key in events) {
            if (events[key].event_id == event_id) {
                return events[key];
            }
        }  
    },
    
    $scope.getEventIdByClientId = function(id){
        events = $('#calendar').fullCalendar('clientEvents');
        
        for (var key in events) {
            if (events[key]._id == id.toString()) {
                return events[key].event_id;
            }
        }  
    },
    
    $scope.getClientIdByEventId = function(event_id){
        events = $('#calendar').fullCalendar('clientEvents');
        
        for (var key in events) {
            if (events[key].event_id == event_id.toString()) {
                return events[key]._id;
            }
        }  
    },
    
    $scope.checkIfClientEventExists = function(event_id){
        events = $('#calendar').fullCalendar('clientEvents');
        
        for (var key in events) {
            if (events[key].event_id == event_id) {
                return true;
            }
        }  
        
        return false;
    },
    
    $scope.deleteEventAndRefreshLeftColumn = function(event_id, year){

        $http.post('/calendars/delete_event', {event_id: event_id}).success(function() {
            
            $scope.refreshLeftColumnEvents();       
            $http.post('/calendars/saveWorkTimes', {year: year});
        });
    }  
    
    $scope.addPeople = function(title, event_id){
        angular.element('.add-people-form').show();
        angular.element('.add-people-form h3').text(title);
        angular.element('.add-people-form #event_id').val(event_id);
    };
    
    /*
     * Przypisanie nowego użytkownika do wydarzenia
     */
    $scope.addPerson = function(){
        profile_id =  angular.element('.add-people-form #profile').val();
        profile_name = angular.element('.add-people-form #profile option:selected').text();
        title = angular.element('.add-people-form .event-form-title').text();
        event_id = angular.element('.add-people-form #event_id').val();
        
        angular.element('.add-people-form #profile').val('0');
        
        eventContainer = angular.element('.deleteExternalEvent[event_id=' + event_id + ']').parent();
        
        eventContainer.append('<div profile_id="' + profile_id + '" class="person">' + profile_name + '<i class="fa fa-close" title="Usuń osobę" data-placement="top" data-toggle="tooltip"></i></div>'); 

        $('[data-toggle="tooltip"]').tooltip(); 
        
        $scope.updateEventsProfiles(eventContainer, event_id);
    };
     
    /*
     * Usunięcie użytkownika z wydarzenia
     */
    $scope.removePerson = function(event_id){
        eventContainer = angular.element('.deleteExternalEvent[event_id=' + event_id + ']').parent();
        $scope.updateEventsProfiles(eventContainer, event_id);
    };
    
    /*
     * Update profili przypisanych do wydarzenia
     */
    $scope.updateEventsProfiles = function(eventContainer, event_id){
        profiles = [];
        
        angular.forEach(eventContainer.find('.person'), function(personDiv) {
            
            profileData = [
                personDiv.getAttribute('profile_id'),
                personDiv.childNodes[0].textContent
            ];
            
            profiles.push(profileData);
        });         

        $http.post('/calendars/update_people_event', {profiles: profiles, event_id: event_id});  
    };
    
    /*
     * Ustawienie nowych dat wydarzenia
     */
    $scope.updateEventsDate = function(event_id, date_start, date_end, year){
        data = {
            event_id : event_id,
            date_start : date_start,
            date_end : date_end,
        }
        
        $http.post('/calendars/update_event_dates', {data: data}).success(function(event_id) {
            $scope.refreshLeftColumnEvents();
            
            $http.post('/calendars/saveWorkTimes', {year: year});
        });
    }

    /*
     * tworzenie drugiego takiego samego wydarzenia tylko z innymi datami
     */
    $scope.duplicateEvent = function(event_id, date_start, date_end, copiedEventObject, year){
        data = {
            event_id : event_id,
            date_start : date_start,
            date_end : date_end,
        }

        $http.post('/calendars/duplicate_event', {data: data}).success(function(event_id) { 

            copiedEventObject.event_id = event_id;
            $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
            $scope.refreshLeftColumnEvents();
            
            $http.post('/calendars/saveWorkTimes', {year: year});
        });
    }
    
    /*
     * odświeża wydarzenia w lewej kolumnie
     */
    $scope.refreshLeftColumnEvents = function(){

        $http.post('/calendars/get_calendar.json', {calendar_id : calendar_id}).success(function(data) { 
            $scope.renderLeftColumnEvents(data.calendar.Event);
        });
    }
    
    $scope.getCalendar();
});