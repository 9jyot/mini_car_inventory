(function() {
  //console.log(angular);
  var img = angular.element("#upload-2-queue");
  angular.module('addModel', ['validation', 'validation.rule', 'ui.bootstrap', 'ui.bootstrap.tpls', 'ui.select', 'ngSanitize']) 

  // -------------------
  // controller phase
  // -------------------
  .controller('mdlController', ['$scope', '$injector','$http','$window', function($scope, $injector,$http,$window) {
    // Injector

    var $validationProvider = $injector.get('$validation');
    

    $scope.modelForm = {
      checkValid: $validationProvider.checkValid,
      submit: function(form) {                
        var status = $validationProvider.validate(form);
          console.log(img[0].children.length);
        var img_pth = angular.element("#img-name").val();
            
          if(img_pth.indexOf(',') > -1){
            var params = {
              name:form.name.$viewValue.trim(),
              manufacturer_id:form.manufacturer.$viewValue.trim(),
              color:form.color.$viewValue.trim(),
              note:form.note.$viewValue.trim(),
              manufacturing_year:new Date(form.year.$viewValue).getFullYear(),
              registration_no:form.registrationNo.$viewValue.trim(),
              image:angular.element("#img-name").val()

             };

            //console.log("Params "+params.image_path);
            $http({
                method: 'POST',
                url: '/car_inventory_r/model/model/addModel',
                data: params,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function(response) {
                //console.log(data);
                $.growl.notice({ title: "Success!", message: response.data.msg });
                //$scope.ModelForm.$setPristine();
                 $window.location.reload();
               
            }).catch(function(err) {
              // handle errors
              //console.log(err);
            });            

          }else{

            $.growl.error({ title: "Image Required", message: "Atleast 2 images required to be uploaded" });
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
