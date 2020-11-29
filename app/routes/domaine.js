/**
 * Created by aureliengarret on 12/06/2016.
 */
'use strict';

module.exports = function(router) {
    //------ LOAD CONTROLLER
    var domaineController = require('../controllers/domaine');

    // -------- Retrieve all domains from the database
    router.get('/domaines',domaineController.getAll);
    router.get('/connect/:user/:pwd', domaineController.connect);
    router.get('/hist/:user', domaineController.hist);
    router.get('/sauv/:carb/:carbsp/:user', domaineController.sauv);

};