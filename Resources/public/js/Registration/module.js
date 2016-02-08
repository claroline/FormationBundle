/*
 * This file is part of the Claroline Connect package.
 *
 * (c) Claroline Consortium <consortium@claroline.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

(function () {
    'use strict';

    var module = angular.module('CursusRegistrationModule', [
        'ngRoute',
        'ui.tree',
        'ui.translation',
        'data-table',
        'ui.bootstrap',
        'ui.bootstrap.tpls',
        'CursusModule'
    ]);

    module.config([
        '$routeProvider',
        function($routeProvider) {
            $routeProvider.
                when('/registration/main/menu', {
                    templateUrl: AngularApp.webDir + 'bundles/clarolinecursus/js/Registration/Partial/cursus_registration_main_menu.html'
                }).
                when('/registration/cursus/list', {
                    templateUrl: AngularApp.webDir + 'bundles/clarolinecursus/js/Registration/Partial/cursus_registration_cursus_list.html',
                    controller: 'CursusRegistrationCtrl',
                    controllerAs: 'crc'
                }).
                when('/registration/searched/cursus/:search', {
                    templateUrl: AngularApp.webDir + 'bundles/clarolinecursus/js/Registration/Partial/cursus_registration_searched_cursus_list.html',
                    controller: 'CursusRegistrationSearchCtrl',
                    controllerAs: 'crsc'
                }).
                when('/registration/cursus/:cursusId/management', {
                    templateUrl: AngularApp.webDir + 'bundles/clarolinecursus/js/Registration/Partial/cursus_registration_cursus_management.html',
                    controller: 'CursusRegistrationManagementCtrl',
                    controllerAs: 'crmc'
                }).
                when('/registration/management', {
                    templateUrl: AngularApp.webDir + 'bundles/clarolinecursus/js/Registration/Partial/cursus_registration_management.html',
                    controller: 'CursusRegistrationCtrl',
                    controllerAs: 'crc'
                }).
                otherwise({
                    redirectTo: '/registration/main/menu'
                });
        }
    ]);
})();