(function () {
    'use strict';

    angular
        .module('app')
        .service('CinemaService', CinemaService)

    /** @ngInject */
    CinemaService.$inject = ['$http', '$q'];

    function CinemaService($http) {

        var sv = this;
        var url = 'http://localhost/apps/peliculas_series/service/webapis/api/cinema.php';
        sv.getCinema = getCinema;
        sv.deleteCinema = deleteCinema;
        sv.getBetters = getBetters;
        sv.getRecents = getRecents;
        sv.findCinema = findCinema;
        sv.addCinema = addCinema;
        sv.setQualification = setQualification;



        function getCinema() {
            return $http.get(`${url}/cinema`);
        }

        function deleteCinema(idCinema) {
            return $http.put(`${url}/cinema/eliminar/${idCinema}`);
        }

        function getBetters(idCinema) {
            return $http.get(`${url}/betters`);
        }

        function getRecents() {
            return $http.get(`${url}/recents`);
        }

        function findCinema(query) {
            return $http.get(`${url}/cinema/${query}`);
        }

        function addCinema(data) {
            return $http.post(`${url}/cinema`, data);
        }

        function setQualification(idCinema, value) {
            var data = {id_cinema: idCinema, value: value};
            console.log(data)
            return $http.post(`${url}/cinema/calificar`, data);
        }
    }

}());