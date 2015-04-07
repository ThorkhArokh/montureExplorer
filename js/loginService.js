var loginService = angular.module('loginService', ['ngResource']);

loginService.factory('LoginFactory', function ($http) {
    return {
    	getUserSession: function() {
    		return $http({
                url: 'back/service/getUserSession.php',
                method: 'GET'
    		});
    	},
        connect: function (login, password) {
            return $http({
                url: 'back/service/connectUser.php',
                method: 'GET',
                params: {login: login, password: password}
            });
        },
        disconnect: function (login) {
            return $http({
                url: 'back/service/disconnectUser.php',
                method: 'GET',
                params: {login: login}
            });
        }
    };
});