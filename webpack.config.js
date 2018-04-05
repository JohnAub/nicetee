var Encore = require('@symfony/webpack-encore');

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .addEntry('app', './assets/js/app.js')
    .addEntry('user', './assets/js/user.js')
    .addEntry('vote', './assets/js/vote.js')
    .addEntry('tee', './assets/js/tee.js')
    .addEntry('validCommande', './assets/js/validCommande.js')
    .enableVueLoader()
    .enableSassLoader()
;

module.exports = Encore.getWebpackConfig();