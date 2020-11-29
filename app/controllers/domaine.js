/**
 * Created by aureliengarret on 12/06/2016.
 */
var DomaineController = exports;

var Util = require('../helpers/appUtils');

DomaineController.getAll = function(req, res) {

    Util.info('Load all domains');

    global.con.connect(function(err) {
        if (err) {
            console.log('Error connecting to Db');
            console.log(err);
            return;
        }

    });

    var query = 'select d.id as domid, d.commentaires as help, d.label as domaine, ct.label as cat, c.label, c.unite, c.id, c.priorite as priorite  ' +
        'from micmac.domaine as d, micmac.champ as c, micmac.champ_type as ct ' +
        'where d.id =c.id_domaine and c.id_champ_type = ct.id';
    global.con.query(query, function(err, rows) {
        if (err) {
            res.status(200).json({
                error: true
            });
        }
        console.log('Data received from Db:\n');
        console.log(rows);

        res.status(200).json(rows);

        global.con.end();
    });

    console.log('Connection established to mysql');


};

DomaineController.connect = function(req, res) {
    Util.info('User connect');
    var user = req.params.user,
        pwd = req.params.pwd;


    var query = "SELECT count(*) as connected " +
        "FROM micmac.user " +
        "WHERE login = '" + user + "' " +
        "AND mdp = '" + pwd + "'";

    console.log(query);

    global.con.query(query, function(err, rows) {
        console.log(err);
        if (err) {
            res.status(200).json({
                error: true
            });
        }
        console.log('Data received from Db:\n');
        console.log(rows);

        global.con.end();
        res.status(200).json(rows);

    });


}


DomaineController.hist = function(req, res) {
    Util.info('Hist');

    var user = req.params.user;

    var query = "SELECT r.total_general, r.total_general_SP, r.date_push FROM micmac.resultat r WHERE  r.login = '" + user + "'";

    console.log(query);

    global.con.query(query, function(err, rows) {
        console.log(err);
        if (err) {
            res.status(200).json({
                error: true
            });
        }
        console.log('Data received from Db:\n');
        console.log(rows);

        global.con.end();
        res.status(200).json(rows);

    });
}

DomaineController.sauv = function(req, res) {
    Util.info('Sauv');

    var carb = req.params.carb;
    var carbsp = req.params.carbsp;
    var user = req.params.user;

    var query = "insert into micmac.resultat ( total_general, total_general_SP, login) values ( " + carb + "," + carbsp + ", '" + user + "' ) ";

    console.log(query);

    global.con.query(query, function(err, rows) {
        console.log(err);
        if (err) {
            res.status(200).json({
                error: true
            });
        }
        console.log('Data received from Db:\n');
        console.log(rows);

        global.con.end();
        res.status(200).json({
            insert: true
        });
    });
}