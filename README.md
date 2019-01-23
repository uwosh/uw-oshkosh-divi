# uw-oshkosh-divi

A child theme fitting [UW Oshkosh](http://uwosh.edu) branding standards for Wordpress sites using [Divi](https://www.elegantthemes.com/gallery/divi/) as the parent theme.

Development of this project is helped tremendously by the lovely people at BrowserStack. They allow me to test this project on multiple browsers and platforms. Seriously, go [check them out](https://www.browserstack.com/)!

![browserstack logo](https://p14.zdusercontent.com/attachment/1015988/tzIpYKGxdVA5yL9oqpZJXkvje?token=eyJhbGciOiJkaXIiLCJlbmMiOiJBMTI4Q0JDLUhTMjU2In0..mrpCPPkyDSRDqkCHM20tJA.jQ7rsbvp99OXWBx_OCYvqo6W5bfF4LYP0KH8m5ad-R8QMY40-8yjf8cgsCeCvLQIcRe8t0Apox5hw4vbiRaRUQcOIJee_yCHNkDphxV7-bNJlfyesANLhR54PcTmATw52gj9WxOSrbMm0DUhJLoksbwX9ecWMJnuFPYZt53woemaJwNx-Fbqga50TXIwQbB3wIGmKlI6H-VmF2UDEJnfhyX5oUGUuS8MUotloZ74J0X531ZmypLll-PoOuOrg2g3U_cDwcOrD9Su1pNFt2lOUvzyBzs8XgXWV01nP2RJwPc.b2VeNUJfeDWWmLGmq3hFag)

## Installation

After cloning the repository, ensure that you have [Node](https://nodejs.org/en/download/), [NPM](https://docs.npmjs.com/downloading-and-installing-node-js-and-npm), and [Gulp](https://gulpjs.com/docs/en/getting-started/quick-start) installed on your local machine.

Change directory (`cd`) into the installation folder you cloned and run `npm install`.

![npm install](https://i.imgur.com/wipnhhO.png)

## Running for development

I recommend using [Local by Flywheel](https://local.getflywheel.com/) as a LAMP server while you develop. It's easy and free.

Set up a new website at the URL specified in the wpgulp.config.js, which is, by default, set to `uwosh.dev`. This can be set to whatever you want.

## Commands

`npm start`: Given that you have a local LAMP server running at the URL specified in the wpgulp.config.js file, this will start a browsersync server so live reloading will happen as you save files.

`gulp deploy`: Deploys a build folder with all minifed contents of your project and a zipped file for easy upload to you WordPress site.

### Other commands

`gulp images`: Optimizes images

`gulp translate`: Generates WP POT translation file.

`gulp stylesRTL`: Generates a Right-To-Left stylesheets and Sourcemap.
