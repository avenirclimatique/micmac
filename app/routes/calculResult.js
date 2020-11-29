/**
 * Created by geoff on 26/06/2016.
 */
'use strict';

module.exports = function(router) {
    //------ LOAD CONTROLLER
    var calculResultController = require('../controllers/calculResult');

    // -------- Retrieve all result from the database
    router.get('/calculResult',calculResultController.getAll);


};