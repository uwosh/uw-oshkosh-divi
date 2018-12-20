# uw-oshkosh-divi

A child theme fitting [UW Oshkosh](http://uwosh.edu) branding standards for Wordpress sites using [Divi](https://www.elegantthemes.com/gallery/divi/) as the parent theme.

Development of this project is helped tremendously by the lovely people at BrowserStack. They allow me to test this project on multiple browsers and platforms. Seriously, go [check them out](https://www.browserstack.com/)!

![browserstack logo](https://p3.zdusercontent.com/attachment/1015988/oRXH2kjJquNC4l95XxJOj7ASv?token=eyJhbGciOiJkaXIiLCJlbmMiOiJBMTI4Q0JDLUhTMjU2In0..juEEjqo3cLfqCd-FskkPng.svNmioknEN2-peMaEMSxhiMuTMyVfy1psLHB411jFkGR8oPbnypXZgeoNcxOCi0fN8Jx8gnb56Dh1VLoKJXXcOZYXQ4HVjtQJCUHyozvQxP6X2kEyVvOZDxt6CDiS_ym3bam5Lgh2xT2BWSdBi7RHnJXh_VP36fBQa6UBW_cxq7hrBG6BUaFOxWJsh4uC3I0cJpAlSBdo5O1B89pmWu0gT1dWkDzuKG4VjC8MtcJabGVPf7nrBOXH0VhuX2s4J8YFNn5oW1OJbX92vs6IHHk680LdAmDDQBml3G4MKrJIxk.ZQc4LuToizWs24mbwOCXmQ)

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
