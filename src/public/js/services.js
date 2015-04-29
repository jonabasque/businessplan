(function () {

  angular.module('bp.services', [])

    .factory('bpService', ['$http', '$q', '$filter', function ($http, $q, $filter) {
        var normalize = $filter('normalize');

        return {};

    }]);

})();
