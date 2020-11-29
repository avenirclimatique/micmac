/**
 * Created by aureliengarret on 12/06/2016.
 */

// Initializing system variables
var mysql = require("mysql");
var Stack = require('stackjs');

var con = false;

    con = mysql.createConnection({
        host: "localhost",
        user: "root",
        password: "root"
    });

    con.connect(function (err) {
        if (err) {
            console.log('Error connecting to Db');
            console.log(err);
            return;
        }
        console.log('Connection established to mysql');
    });

// AURÉLIEN NOTE :
// please keep attention here, all terms have to be follow by a space !!!!!!
    var formules = [{
        id_champ : 16,
        f : "B16 * D16 / B13 / 1000 "
    },{
        id_champ : 17,
        f : "B17 * D17 / B13 / 100 "
    },{
        id_champ : 19,
        f : "B19 * D19 / B13 / 100 "
    },{
        id_champ : 20,
        f : "B20 * D20 / B13 "
    },{
        id_champ : 25,
        f : "B25 * D25 * B27 / B26 / 100 "
    },{
        id_champ : 29,
        f : "B29 * D29 * B31 / B30 / 100 "
    },{
        id_champ : 33,
        f : "B33 * D33 * B34 / 100 "
    },{
        id_champ : 36,
        f : "D36 * B36 "
    },{
        id_champ : 38,
        f : "D38 * B38 / 100 "
    },{
        id_champ : 40,
        f : "D40 * B40 * 52 "
    },{
        id_champ : 41,
        f : "D41 * B41 * 52 "
    },{
        id_champ : 46,
        f : "D46 * B46 * 52 * ( 1 - B51 * D51 ) "
    },{
        id_champ : 47,
        f : "D47 * B47 * 52 * ( 1 - B51 * D51 ) "
    },{
        id_champ : 48,
        f : "D48 * B48 * 52 * ( 1 - B51 * D51 ) "
    },{
        id_champ : 49,
        f : "D49 * B49 * 52 "
    },{
        id_champ : 51,
        f : "( G46 + G47 + G48 ) * B51 * D51 / ( 1 - B51 * D51 ) "
    },{
        id_champ : 53,
        f : "D53 * B53 * 52 "
    },{
        id_champ : 54,
        f : "D54 * B54 * 52 "
    },{
        id_champ : 55,
        f : "D55 * B55 * 52 "
    },{
        id_champ : 57,
        f : "D57 * B57 * 52 "
    },{
        id_champ : 58,
        f : "D58 * B58 * 52 "
    },{
        id_champ : 59,
        f : "D59 * B59 * 52 "
    },{
        id_champ : 61,
        f : "D61 * B61 * 52 "
    },{
        id_champ : 63,
        f : "D63 * B63 * 52 "
    },{
        id_champ : 64,
        f : "D64 * B64 * 52 "
    },{
        id_champ : 66,
        f : "D66 * B66 * 52 "
    },{
        id_champ : 67,
        f : "D67 * B67 * 52 "
    },{
        id_champ : 69,
        f : "G69 "
    },{
        id_champ : 74,
        f : "D74 * B74 / 1000 "
    },{
        id_champ : 75,
        f : "D75 * B75 / 1000 "
    },{
        id_champ : 80,
        f : "D80 * B80 / 1000 "
    },{
        id_champ : 81,
        f : "D81 * B81 / 1000 "
    },{
        id_champ : 86,
        f : "D86 "
    }]

    // manque le forfait nucléaire comme indiqué aussi dans le script de création sql


    for (var i = 0; i < formules.length; i++) {
        var postfix = infixToPostfixRe(formules[i].f);

        var query = "update micmac.champ set formule = '" + postfix +"' where id = " + formules[i].id_champ + ";";
        console.log(query);
        con.query(query,function(err,rows){
            if(err){
                console.log('Error during update\n');
                console.log(err);
                return;
            }
            console.log('Update ok\n');
            console.log(rows);

        });
    }




/**
 * infixToPostfixRe
 * @param {String} reStr - a RegExp in transformed view
 * with explicit contatenations: abc -> a.b.c => result: ab.c.
 */
function infixToPostfixRe(reStr) {

    var output = [];
    var stack = new Stack();

    for (var k = 0, length = reStr.length; k < length;  k++) {

        // current char
        var c = reStr[k];

        if (c == '(')
            stack.push(c);

        else if (c == ')') {
            while (stack.peek() != '(') {
                output.push(stack.pop())
            }
            stack.pop(); // pop '('
        }

        // else work with the stack
        else {
            while (stack.size()) {
                var peekedChar = stack.peek();

                var peekedCharPrecedence = precedenceOf(peekedChar);
                var currentCharPrecedence = precedenceOf(c);

                if (peekedCharPrecedence >= currentCharPrecedence) {
                    output.push(stack.pop());
                } else {
                    break;
                }
            }
            stack.push(c);
        }

    } // end for loop

    while (stack.size())
        output.push(stack.pop());

    var result = output.join("");

    console.log(reStr, "=>", result);

    return result;

}

function precedenceOf(c) {
    switch (c) {
        case '(': return 1;
        case'|': return 2; // alternate
        case '.': return 3; // concatenate
        case '?': return 4; // zero or one
        case '*': return 4; // zero or more
        case '+': return 4; // one or more
        case '^': return 5; // complement
        default : return 6;
    }
}