const urlapi = require('url');
const siteUrl = 'http://ready-for-feedback3.com/gngf/von-hacht-associates/', // example `http://site-url.com/`
	themeName = 'von-hacht-associates'; // example `project-name`
const URL = urlapi.parse(siteUrl);

module.exports = {
	"files": ["css/css/*.css","*.php", "parts/**/*.php", "templates/*.php", "js/global.js"],
	"proxy": siteUrl,
	"serveStatic": ["./"],

	rewriteRules: [
		{
			match: new RegExp( URL.path.substr(1) + "wp-content/themes/" + themeName + "/assets/css" ),
			fn: function () {
				return "assets/css"
			}
		},
		{
			match: new RegExp( URL.path.substr(1) + "wp-content/themes/" + themeName + "/assets/css/custom.css" ),
			fn: function () {
				return "assets/css/custom.css"
			}
		}
	],
};
