var montureController = angular.module('montureController', []);

montureController.controller('MonturesListCtrl', ['$scope', 'MontureFactory', 'ReferentielFactory', 'LoginFactory', 
    function ($scope, MontureFactory, ReferentielFactory, LoginFactory) {
        $scope.erreurMessage = "";
        $scope.factionChoix = "0";
        $scope.typeChoix = "0";
        $scope.typesList = [];
        $scope.factionsList = [];
        $scope.montureList = [];
        $scope.connect=false;
        $scope.showLogin=false;
        $scope.loginStr="";
        $scope.passwordStr="";
        $scope.pageSize=6;
        
        $scope.loading = true;
        
        $scope.showMore = function() {
        	$scope.pageSize+=6;
        }
        
        LoginFactory.getUserSession().success(function (data, status, headers, config) {
        	if (data.success) {
                $scope.connect=true;
        		$scope.showLogin=false;
        		$scope.loginStr=data.nom
        		$scope.erreurMessage = "";
            } 
        });
        
        $scope.connectUser = function() {
        	$scope.showLogin=!$scope.showLogin;
        	$scope.erreurMessage = "";
        };
        
        $scope.disconnectUser = function() {
        	$scope.connect=false;
        	LoginFactory.disconnect($scope.loginStr);
        };
        
        $scope.login = function() {
        	LoginFactory.connect($scope.loginStr, $scope.passwordStr).success(function (data, status, headers, config) {
                if (data.success) {
                    $scope.connect=true;
        			$scope.showLogin=false;
        			$scope.erreurMessage = "";
                } else {
                    $scope.erreurMessage = data.message;
                }
        	});
        };
        
        $scope.swiped = function(direction) {
            console.log('Swiped ' + direction);
          };
        
        ReferentielFactory.getTypes().success(function (data, status, headers, config) {
                if (data.success) {
                    $scope.typesList = data.data;
                } else {
                    $scope.erreurMessage = data.message;
                }
            });
        ReferentielFactory.getFactions().success(function (data, status, headers, config) {
                if (data.success) {
                    $scope.factionsList = data.data;
                } else {
                    $scope.erreurMessage = data.message;
                }
            });
        
        MontureFactory.get().success(function (data, status, headers, config) {
                $scope.loading = false;
                if (data.success) {
                    $scope.montureList = data.data;
                } else {
                    $scope.erreurMessage = data.message;
                }
            });

        $scope.checkMonture = function (id) {
            MontureFactory.check(id).success(function (data, status, headers, config) {
                if (data.success) {
                    for (montureKey in $scope.montureList) {
                    	monture = $scope.montureList[montureKey];
		                if (monture.id === id) {
		                    monture.isObtenu = !monture.isObtenu;
		                    break;
		                }
		            }
                } else {
                    $scope.erreurMessage = data.message;
                }
            });
        };
        
        $scope.checkFavoris = function (id) {
            MontureFactory.checkFavoris(id).success(function (data, status, headers, config) {
                if (data.success) {
                    for (montureKey in $scope.montureList) {
                    	monture = $scope.montureList[montureKey];
		                if (monture.id === id) {
		                    monture.isFavoris = !monture.isFavoris;
		                    break;
		                }
		            }
                } else {
                    $scope.erreurMessage = data.message;
                }
            });
        };
    }]);