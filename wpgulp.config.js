/**
 * WPGulp Configuration File
 *
 * 1. Edit the variables as per your project requirements.
 * 2. In paths you can add <<glob or array of globs>>.
 *
 * @package WPGulp
 */

const themeName = 'dravet';
//const year = new Date().getFullYear();
const year = '2019';
const projectName = themeName + '.' + year;

module.exports = {

	// Project options.
	projectName: themeName + '.' + year,
	projectURL: 'dravet.development', // Local project URL of your already running WordPress site. Could be something like wpgulp.local or localhost:3000 depending upon your local WordPress setup.
	productURL: './', // Theme/Plugin URL. Leave it like it is, since our gulpfile.js lives in the root folder.
	browserAutoOpen: false,
	injectChanges: true,

	// Theme options.
	themeSRC: './src/theme/**',

	// Style options.
	styleSRC: './src/assets/scss/style.scss', // Path to main .scss file.
	styleAdminSRC: './src/assets/scss/admin.scss', // Path to main .scss file.
	styleLoginSRC: './src/assets/scss/login.scss', // Path to main .scss file.
	styleDestination: './app/public/wp-content/themes/' + projectName , // Path to place the compiled CSS file. Default set to root folder.
	outputStyle: 'compact', // Available options → 'compact' or 'compressed' or 'nested' or 'expanded'
	errLogToConsole: true,
	precision: 10,

	// JS Header options.
	jsHeaderSRC: './src/assets/js/header/*.js', // Path to JS Header folder.
	jsHeaderDestination: './app/public/wp-content/themes/' + projectName + '/js', // Path to place the compiled JS Headers file.
	jsHeaderFile: 'header.script', // Compiled JS Headers file name. Default set to Headers i.e. Headers.js.

	// JS Footer options.
	jsFooterSRC: './src/assets/js/footer/*.js', // Path to JS Footer scripts folder.
	jsFooterDestination: './app/public/wp-content/themes/' + projectName + '/js', // Path to place the compiled JS Footer scripts file.
	jsFooterFile: 'footer.script', // Compiled JS Footer file name. Default set to Footer i.e. Footer.js.

	// JS Admin options.
	jsAdminSRC: './src/assets/js/admin/*.js', // Path to JS Admin scripts folder.
	jsAdminDestination: './app/public/wp-content/themes/' + projectName + '/js', // Path to place the compiled JS Admin scripts file.
	jsAdminFile: 'admin.script', // Compiled JS Admin file name. Default set to Admin i.e. Admin.js.

	// JS Footer options.
	jsLoginSRC: './src/assets/js/login/*.js', // Path to JS login scripts folder.
	jsLoginDestination: './app/public/wp-content/themes/' + projectName + '/js', // Path to place the compiled JS login scripts file.
	jsLoginFile: 'login.script', // Compiled JS Login file name. Default set to Login i.e. Login.js.


	// Fonts options
	fontsSRC: './src/assets/fonts/**',
	fontsDestination: './app/public/wp-content/themes/' + projectName + '/fonts/',

	// Images options.
	imgSRC: './src/assets/images/**/*', // Source folder of images which should be optimized and watched. You can also specify types e.g. raw/**.{png,jpg,gif} in the glob.
	imgDST: './app/public/wp-content/themes/' + projectName + '/images/', // Destination folder of optimized images. Must be different from the imagesSRC folder.
	iconFilename: 'symbol-defs',
	iconSRC: './src/assets/icons/**/*',
	iconDestination: './app/public/wp-content/themes/' + projectName + '/images/',

	// Build Options
	buildDestination: './dist/themes/',

	// Watch files paths.
	watchTheme: './src/theme/**/*',
	watchStyles: './src/assets/scss/**/*.scss', // Path to all *.scss files inside css folder and inside them.
	watchJSHeader: './src/assets/js/header/*.js', // Path to all vendor JS files.
	watchJSFooter: './src/assets/js/footer/*.js', // Path to all custom JS files.
	watchJSAdmin: './src/assets/js/admin/*.js', // Path to all custom JS files.
	watchJSLogin: './src/assets/js/login/*.js', // Path to all custom JS files.
	watchIcons: './src/assets/icons/**/*.svg',
	watchPhp: '.src/**/*.php', // Path to all PHP files.

	// Translation options.
	textDomain: themeName, // Your textdomain here.
	translationFile: themeName + '.pot', // Name of the translation file.
	translationDestination: './app/public/wp-content/themes/' + projectName + '/languages', // Where to save the translation files.
	packageName: themeName, // Package name.
	bugReport: 'https://mauricenaef.ch', // Where can users report bugs.
	lastTranslator: 'Maurice Naef <me@mauricenaef.ch>', // Last translator Email ID.
	team: 'Maurice Naef <me@mauricenaef.ch>', // Team's Email ID.

	// Browsers you care about for autoprefixing. Browserlist https://github.com/ai/browserslist
	// The following list is set as per WordPress requirements. Though, Feel free to change.
	BROWSERS_LIST: [
		'last 2 version',
		'> 1%',
		'ie >= 11',
		'last 1 Android versions',
		'last 1 ChromeAndroid versions',
		'last 2 Chrome versions',
		'last 2 Firefox versions',
		'last 2 Safari versions',
		'last 2 iOS versions',
		'last 2 Edge versions',
		'last 2 Opera versions'
	]
};
