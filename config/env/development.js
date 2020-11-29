'use strict';

module.exports = {
    // ---- Main app configuration
    app: {
        name    : 'MicMac',
        url     : 'http://avenirclimatique.org/micmac',
        type    : 'Development',
        version : 'TD3.0'
    },
    // ---- Database configuration
    db: {
        module : 'mysql',
        url    : "avenirclsite.mysql.db",
        login  : "avenirclsite",
        pwd    : "dztDYYmqppYC"
    },
    // ---- Params Allowed Origins by environment
    allowedOrigins : [ 'localhost:*', '0.0.0.0:*','127.0.0.1:*']
};

