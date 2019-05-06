(function() {
  angular.module('addManufacturer', ['validation', 'validation.rule', 'ui.bootstrap', 'ui.bootstrap.tpls', 'ui.select', 'ngSanitize'])

  // -------------------
  // config phase
  // -------------------
  .config(['$validationProvider', function($validationProvider) {
    var defaultMsg;
    var expression;

    /**
     * Setup a default message for Url
     */
    defaultMsg = {
      url: {
        error: 'This is a error url given by user',
        success: 'It\'s Url'
      }
    };

    $validationProvider.setDefaultMsg(defaultMsg);


    /**
     * Setup a new Expression and default message
     * In this example, we setup a IP address Expression and default Message
     */
    expression = {
      ip: /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/
    };

    defaultMsg = {
      ip: {
        error: 'This isn\'t ip address',
        success: 'It\'s ip'
      }
    };

    $validationProvider.setExpression(expression)
      .setDefaultMsg(defaultMsg);

    // or we can just setup directly
    $validationProvider.setDefaultMsg({
        ip: {
          error: 'This no ip',
          success: 'this ip'
        }
      })
      .setExpression({
        ip: /^(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.(25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/
      });

    /**
     * Additions validation
     */
    $validationProvider
      .setExpression({
        huei: function(value, scope, element, attrs) {
          return value === 'Huei Tan';
        }
      })
      .setDefaultMsg({
        huei: {
          error: 'This should be Huei Tan',
          success: 'Thanks!'
        }
      });

    /**
     * Range Validation
     */
    $validationProvider
      .setExpression({
        range: function(value, scope, element, attrs) {
          if (value >= parseInt(attrs.min) && value <= parseInt(attrs.max)) {
            return value;
          }
        }
      })
      .setDefaultMsg({
        range: {
          error: 'Number should between 5 ~ 10',
          success: 'good'
        }
      });
  }])

  // -------------------
  // controller phase
  // -------------------
  .controller('mfgController', ['$scope', '$injector','$http', function($scope, $injector,$http) {
    // Injector

    var $validationProvider = $injector.get('$validation');



   

    $scope.manufacturerForm = {
      checkValid: $validationProvider.checkValid,
      submit: function(form) {                
        var status = $validationProvider.validate(form); 
        console.log(status);
        
         //console.log($scope.ManufacturerForm.manufacturer.$modelValue.length);
        
         //console.log($scope.ManufacturerForm.$setPristine);
         //console.log($scope.manufacturerForm.required);
         //$scope.ManufacturerForm.$modelValue = '';

         
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

    

    $scope.form6 = {
      required: [{}, {}, {}], // ng-repeat
      checkValid: $validationProvider.checkValid
    };

    // Bootstrap Datepicker
    $scope.form7 = {
      dt: new Date(),
      open: function($event) {
        $scope.form7.status.opened = true;
      },
      dateOptions: {
        formatYear: 'yy',
        startingDay: 1
      },
      status: {
        opened: false
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
