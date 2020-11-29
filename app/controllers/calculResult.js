/**
 * Created by geoff on 26/06/2016.
 */

var calculResultController = exports;

var Util = require('../helpers/appUtils');

calculResultController.getAll = function(req, res){

    Util.info('Load all formule');


    var query = 'SELECT c.id as id, c.label as label, c.valeurUnitaireCarbone as valeurUnitaireCarbone, c.unite as unite, c.formule as formule, c.id_domaine as id_domaine, c.id_champ_type as id_champ_type, c.priorite as priorite ' +
            'FROM micmac.champ as c';
    global.con.query(query,function(err,rows){
        if(err){
            res.status(200).json({error: true});
        }
        console.log('Data received from Db:\n');
        console.log(rows);
        console.log(err);

        res.status(200).json(rows);

    });

    console.log('Connection established to mysql');


};