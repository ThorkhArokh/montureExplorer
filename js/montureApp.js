var monturesApp = angular.module('monturesApp', ['ngRoute', 'ngSanitize', 'mobile-angular-ui', 'mobile-angular-ui.gestures', 'montureModule']);

monturesApp.filter('masquerObtenuesFiltre', function () {
    return function (items, masquerObtenues) {

        if (masquerObtenues) {
            var filtered = [];

            for (var i = 0; i < items.length; i++) {
                var item = items[i];
                if (!item.isObtenu) {
                    filtered.push(item);
                }
            }

            return filtered;
        } else {
            return items;
        }
    };
});

monturesApp.filter('showFavorisFiltre', function () {
    return function (items, showFavoris) {

        if (showFavoris) {
            var filtered = [];

            for (var i = 0; i < items.length; i++) {
                var item = items[i];
                if (item.isFavoris) {
                    filtered.push(item);
                }
            }

            return filtered;
        } else {
            return items;
        }
    };
});

monturesApp.filter('factionFiltre', function () {
    return function (items, factionChoix) {
        if (factionChoix < 1) {
            return items;
        } else {
            var filtered = [];

            for (var i = 0; i < items.length; i++) {
                var item = items[i];
                if (item.faction && item.faction.id === factionChoix) {
                    filtered.push(item);
                }
            }

            return filtered;
        }
    };
});

monturesApp.filter('typeFiltre', function () {
    return function (items, typeChoix) {
        if (typeChoix < 1) {
            return items;
        } else {
            var filtered = [];

            for (var i = 0; i < items.length; i++) {
                var item = items[i];
                if (item.type && item.type.id === typeChoix) {
                    filtered.push(item);
                }
            }

            return filtered;
        }
    };
});