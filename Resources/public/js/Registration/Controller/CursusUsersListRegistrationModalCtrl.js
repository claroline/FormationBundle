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

    angular.module('CursusRegistrationModule').controller('CursusUsersListRegistrationModalCtrl', [
        '$http',
        '$uibModalStack',
        'cursusId',
        function ($http, $uibModalStack, cursusId) {
            var vm = this;
            this.cursusId = cursusId;
            
            this.closeModal = function () {
                $uibModalStack.dismissAll();
            };
        }
    ]);
})();