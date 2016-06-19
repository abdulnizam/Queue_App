var queueApp = angular.module('queueApp',[]); //declaration of angular app 

queueApp.controller("queueCtrl",function($scope,$http){ //angular controller for queuing application
	
	$scope.services = {"0":"Housing","1":"Benefits","2":"Counsil Tax","3":"Fly-tipping","4":"Missed Bin"}; //services should be listed in new customer section 
	$scope.customerTypes = {"0":"Citizen","1":"Organization","2":"Anonymous"};
	
	$scope.formData = {};
	
	$scope.formData.customerType = 0;
	
	$scope.data=[];
	$scope.newCustomerMessage = {};
	        
	$scope.submitNewCustomer=function($event){
		var name = '';
		if($scope.formData.customerType == 0){
			name = $scope.formData.title +" "+ $scope.formData.firstName +" "+ $scope.formData.lastName;
		}
		else if ($scope.formData.customerType == 1){
			name = $scope.formData.organizationName;
		}
		var postData = $.param({
            service_type: $scope.formData.serviceType,
            customer_type: $scope.formData.customerType,
			name: name
            });
        $http.post("app/Services/addCustomer.php",postData,{headers: {'Content-Type': 'application/x-www-form-urlencoded'}}).success(function(responseJson, status) {
            $scope.newCustomerMessage = responseJson;
            if(!isNaN(responseJson.customer_id)){
            	$scope.data.push({service_type:$scope.formData.serviceType,customer_type:$scope.formData.customerType,name:name,id:responseJson.customer_id,priority:0,is_served:0,queued_at:new Date()});
            	$scope.resetInputForm();
            }
        });
	}
	$scope.resetInputForm=function(){
		$scope.formData = {};
		$scope.formData.customerType = 0;
	}
	$scope.serve=function(id){
		$http.get("app/Services/serveCustomer.php?id="+id).success(function(responseJson, status) {
            $scope.newCustomerMessage = responseJson;
            
            	for(var i in $scope.data){
            		if($scope.data[i].id == id){
            			$scope.data[i].is_served = 1;
            		}
            	}
            
        });
	}
	var init = function () {
			$http.get("app/Services/getCustomerDetails.php").success(function(responseJson,status){
			$scope.data  = responseJson;
		});
	};
	init();
});
