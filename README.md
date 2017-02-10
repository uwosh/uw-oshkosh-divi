# Install

## Prerequisites

### 1. [Node.js](https://nodejs.org)

Bring up a terminal and type `node --version`.
Node should respond with a version at or above 0.10.x.
If you require Node, go to [nodejs.org](https://nodejs.org) and click on the big green Install button.

### 2. [Gulp](http://gulpjs.com)

After installing Node, bring up a terminal and type `npm install gulp-cli -g`

### 3. [Ruby](https://www.ruby-lang.org/en/documentation/installation/)

Select your operating system from the list and install Ruby making sure to add Ruby to your system path.

### Install local dependencies
1. Navigate to the repository in a terminal window
2. Run ```npm install```
3. The Sass linter requires Ruby and <a href='https://github.com/causes/scss-lint' target='_blank'>scss-lint</a>. Run ```gem install scss_lint```

It should be noted that this package runs some UNIX commands, so this won't work on Windows. It does work on Linux and Mac.

That's it! You should have everything you need to run scripts for uw-oshkosh-divi.

# Commands

There are two basic build commands this this package uses.

1. ```gulp build``` builds the project and places it in the builds folder. This build minifes CSS and JavaScript. Image compression is enabled.
3. ```gulp serve``` rebuilds the theme and starts a watch on your files to serve them to your local web stack on save.

# About uw-oshkosh-divi
A child theme for UW Oshkosh Wordpress sites using the Divi parent theme.

This theme is a child theme of <a href='http://www.elegantthemes.com/gallery/divi/' target='_blank'>Divi</a> by <a href='http://www.elegantthemes.com/' target='_blank'>Elegant Themes</a>.
