/* 
 * Kontroler wniosków urlopowych
 */

app.controller('VacationsCtrl', function($scope, $http) {
    
    $scope.getVacations = function() {
        
        $http.post('/vacations/vacation_applications.json').success(function(data) {
            $scope.vacations = data.vacations;
            angular.forEach($scope.vacations, function(vacationData) {
                vacationData.Vacation.id = parseInt(vacationData.Vacation.id);
                vacationData.Profile.id = parseInt(vacationData.Profile.id);
                if(vacationData.VacationType.is_hours){
                    vacationData.Vacation.working_days = 0;
                    vacationData.Vacation.working_hours = vacationData.Vacation.private_time;
                } else {
                    workingDays = $scope.calculateWorkingDays(vacationData.Vacation.date_start, vacationData.Vacation.date_end);
                    vacationData.Vacation.working_days = workingDays;
                    vacationData.Vacation.working_hours = workingDays * 8;
                }
                vacationData.UserContractHistories.vacation_used = vacationData.UserContractHistories.vacation_days - vacationData.UserContractHistories.vacation_available;
            });
        });
    };
        
    $scope.calculateWorkingDays = function(startDate, endDate) {
        startDate = new Date(startDate);
        endDate = new Date(endDate);
        
        var result = 0;
        var currentDate = startDate;
        
        while (currentDate <= endDate)  {  
            var weekDay = currentDate.getDay();
            if(weekDay != 0 && weekDay != 6)
                result++;

                currentDate.setDate(currentDate.getDate()+1); 
        }

        return result;
    };
  
    $scope.changeVacationStatus = function(vacation, newStatus) {
        vacation.Vacation.vacation_status_id = newStatus;
        
        vacation_available = vacation.UserContractHistories.vacation_available - vacation.Vacation.working_days;
        vacation_used = vacation.UserContractHistories.vacation_used + vacation.Vacation.working_days;
        
        //jeśli zatwierdzamy wniosek(i nie jest to wyjście pryatne tj. na godziny) to odliczamy dni wolne od danego profilu (widok)
        if(newStatus == 4 && !vacation.VacationType.is_hous){
            angular.forEach($scope.vacations, function(vacationData) {     
                if(vacationData.UserContractHistories.vacation_days !== null && vacation.Profile.id === vacationData.Profile.id){
                    vacationData.UserContractHistories.vacation_available = vacation_available;       
                    vacationData.UserContractHistories.vacation_used = vacation_used;
                }          
            });
        }

        //zmiana statusu wniosku w bazie danych
        data = {
            vacation_id : vacation.Vacation.id, 
            new_status : newStatus, 
            profile_id : vacation.Profile.id, 
            vacation_days : vacation.Vacation.working_days
        };
        
        $http.post('/vacations/change_vaccation_status', data);
    };
    
    $scope.setClickedVacation = function(vacation){
        $scope.clickedVacation = vacation;
    }
    
    $scope.getVacations();
});