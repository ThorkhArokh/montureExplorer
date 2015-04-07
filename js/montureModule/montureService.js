var montureService = angular.module('montureService', ['ngResource']);

montureService.factory('MontureFactory', function ($http) {
    return {
        get: function () {
            return $http({
            	cache: true,
                url: 'back/service/getMontures.php',
                method: 'GET'
            });
        },
        check: function (id) {
            return $http({
                url: 'back/service/checkMonture.php',
                method: 'GET',
                params: {id: id}
            });
        },
        checkFavoris: function (id) {
            return $http({
                url: 'back/service/checkFavoris.php',
                method: 'GET',
                params: {id: id}
            });
        }
    };
});

montureService.factory('ReferentielFactory', function ($http) {
    return {
        getFactions: function () {
            return $http({
            	cache: true,
                url: 'back/service/getFactions.php',
                method: 'GET'
            });
        },
        getTypes: function () {
            return $http({
            	cache: true,
                url: 'back/service/getTypes.php',
                method: 'GET'
            });
        }
    };
});