(function() {
  angular.module('addManufacturer', ['validation', 'validation.rule', 'ui.bootstrap', 'ui.bootstrap.tpls', 'ui.select', 'ngSanitize']) 

  
  .controller('mfgController', ['$scope', '$injector','$http', function($scope, $injector,$http) {
    // Injector

    var $validationProvider = $injector.get('$validation');



   

    $scope.manufacturerForm = {
      checkValid: $validationProvider.checkValid,
      submit: function(form) {                
        var status = $validationProvider.validate(form);
          
        if(status.$$state.value != "error")
        {     
          var model_val = $scope.ManufacturerForm.manufacturer.$modelValue.trim();
          if(model_val.length > 2){
            var params = {'name':model_val };
            $http({
                method: 'POST',
                url: 'http://localhost/mini_car_inventory/manufacturer/manufacturer/addManufacturer',
                data: params,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function(response) {
                //console.log(data);

                $scope.errorMessage = response.data.msg;
                $scope.manufacturerForm.required='';
                //console.log($scope);
               // console.log(data);
            });

            }else{
              $scope.errorMessage = "Manufacturer name cannot be less then 3 characters";
            }

        }
        
      },
      reset: function(form) {
        $validationProvider.reset(form);
      }
    };
    

    

  

    // Callback method
    $scope.success = function(message) {
      alert('Success ' + message);
    };

    $scope.error = function(message) {
      alert('Error ' + message);
    };
  }]);
}).call(this);
