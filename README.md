### Prerequisites

## [Docker](https://docs.docker.com/engine/installation/)
Make sure you've installed this application and it's running on your machine.

## [Node.js](https://nodejs.org)

Bring up a terminal and type `node --version`.
Node should respond with a version at or above 0.10.x.
If you require Node, go to [nodejs.org](https://nodejs.org) and click on the big green Install button.

## [Gulp](http://gulpjs.com)

Bring up a terminal and type `gulp --version`.
If Gulp is installed it should return a version number at or above 3.9.x.
If you need to install/upgrade Gulp, open up a terminal and type in the following:

```sh
$ npm install --global gulp
```

*This will install Gulp globally. Depending on your user account, you may need to [configure your system](https://github.com/sindresorhus/guides/blob/master/npm-global-without-sudo.md) to install packages globally without administrative privileges.*

## [Ruby](https://www.ruby-lang.org/en/documentation/installation/)

Select your operating system from the list, install Ruby, and make sure to add Ruby to your system path.


### Local dependencies

Next, install the local dependencies UWO WordPress Bundle requires:

```sh
$ npm install && gem install scss_lint
```

That's it! You should now have everything needed to use the UWO WordPress Bundle.

### Usage

Finally, start the UWO WordPress Bundle with `docker-compose up`.

In a separate bash window, there are two main Gulp commands you may run.

## Using Gulp

1. `gulp` - builds the project

2. `gulp serve` - builds the project, opens the site in your web browser, and starts a watch on your `src` folder.

## Using phpMyAdmin

You may log into phpMyAdmin via your web browser at `http://localhost:22222`.

Default login credentials are:

Username: `root`

Password: `root`

## Logging into WordPress

Default login credentials are:

Username: `root`

Password: `root`
