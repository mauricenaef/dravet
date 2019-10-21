/**
 * Gulpfile.
 *
 * Gulp with WordPress.
 *
 * Implements:
 *      1. Live reloads browser with BrowserSync.
 *      2. CSS: Sass to CSS conversion, error catching, Autoprefixing, Sourcemaps,
 *         CSS minification, and Merge Media Queries.
 *      3. JS: Concatenates & uglifies Vendor and Custom JS files.
 *      4. Images: Minifies PNG, JPEG, GIF and SVG images.
 *      5. Watches files for changes in CSS or JS.
 *      6. Watches files for changes in PHP.
 *      7. Corrects the line endings.
 *      8. InjectCSS instead of browser page reload.
 *      9. Generates .pot file for i18n and l10n.
 */

/**
 * Load WPGulp Configuration.
 *
 * TODO: Customize your project in the wpgulp.js file.
 */
const config = require( './wpgulp.config.js' );

/**
 * Load Plugins.
 *
 * Load gulp plugins and passing them semantic names.
 */
const gulp = require( 'gulp' ); // Gulp of-course.
const { series } = require('gulp');
const del = require( 'del' );

// CSS related plugins.
const sass = require( 'gulp-sass' ); // Gulp plugin for Sass compilation.
const minifycss = require( 'gulp-uglifycss' ); // Minifies CSS files.
const autoprefixer = require( 'gulp-autoprefixer' ); // Autoprefixing magic.
const mmq = require( 'gulp-merge-media-queries' ); // Combine matching media queries into one.
const rtlcss = require( 'gulp-rtlcss' ); // Generates RTL stylesheet.

// JS related plugins.
const concat = require( 'gulp-concat' ); // Concatenates JS files.
const uglify = require( 'gulp-uglify' ); // Minifies JS files.
const babel = require( 'gulp-babel' ); // Compiles ESNext to browser compatible JS.

// Image related plugins.
const imagemin = require( 'gulp-imagemin' ); // Minify PNG, JPEG, GIF and SVG images with imagemin.
const svgstore = require( 'gulp-svgstore' );
const cheerio = require( 'gulp-cheerio' );
const svgmin = require( 'gulp-svgmin' );

// Utility related plugins.
const path = require('path');
const size = require('gulp-size');
const rename = require( 'gulp-rename' ); // Renames files E.g. style.css -> style.min.css.
const lineec = require( 'gulp-line-ending-corrector' ); // Consistent Line Endings for non UNIX systems. Gulp Plugin for Line Ending Corrector (A utility that makes sure your files have consistent line endings).
const filter = require( 'gulp-filter' ); // Enables you to work on a subset of the original files by filtering them using a glob.
const sourcemaps = require( 'gulp-sourcemaps' ); // Maps code in a compressed file (E.g. style.css) back to it’s original position in a source file (E.g. structure.scss, which was later combined with other css files to generate style.css).
const notify = require( 'gulp-notify' ); // Sends message notification to you.
const browserSync = require( 'browser-sync' ).create(); // Reloads browser and injects CSS. Time-saving synchronized browser testing.
const wpPot = require( 'gulp-wp-pot' ); // For generating the .pot file.
const sort = require( 'gulp-sort' ); // Recommended to prevent unnecessary changes in pot-file.
const cache = require( 'gulp-cache' ); // Cache files in stream for later use.
const remember = require( 'gulp-remember' ); //  Adds all the files it has ever seen back into the stream.
const plumber = require( 'gulp-plumber' ); // Prevent pipe breaking caused by errors from gulp plugins.
const beep = require( 'beepbeep' );

/**
 * Custom Error Handler.
 *
 * @param Mixed err
 */
const errorHandler = r => {
	notify.onError( '\n\n❌  ===> ERROR: <%= error.message %>\n' )( r );
	beep();

	// this.emit('end');
};

/**
 * Task: `browser-sync`.
 *
 * Live Reloads, CSS injections, Localhost tunneling.
 * @link http://www.browsersync.io/docs/options/
 *
 * @param {Mixed} done Done.
 */
const browsersync = done => {
	browserSync.init({
		proxy: config.projectURL,
		open: config.browserAutoOpen,
		injectChanges: config.injectChanges,
		watchEvents: [ 'change', 'add', 'unlink', 'addDir', 'unlinkDir' ]
	});
	done();
};

// Helper function to allow browser reload with Gulp 4.
const reload = done => {
	browserSync.reload();
	done();
};

// const refresh = gulp.series(cleantheme);

/** 
 * Task: `theme`.
 * 
 * Move all theme files to App directory
 */

gulp.task( 'cleantheme', () => {
	return del( config.styleDestination );
});

gulp.task( 'theme', () => {
	return gulp
		.src( config.themeSRC )
		.pipe( plumber( errorHandler ) )
		.pipe( gulp.dest( config.styleDestination  ) )
		.pipe( notify({ message: '\n\n✅  ===> THEME — completed!\n', onLast: true }) );
});

/**
 * Task: `styles`.
 *
 * Compiles Sass, Autoprefixes it and Minifies CSS.
 *
 * This task does the following:
 *    1. Gets the source scss file
 *    2. Compiles Sass to CSS
 *    3. Writes Sourcemaps for it
 *    4. Autoprefixes it and generates style.css
 *    5. Renames the CSS file with suffix .min.css
 *    6. Minifies the CSS file and generates style.min.css
 *    7. Injects CSS or reloads the browser via browserSync
 */
gulp.task( 'styles', () => {
	const s = size();
	return gulp
		.src( config.styleSRC, { allowEmpty: true })
		.pipe( plumber( errorHandler ) )
		.pipe( sourcemaps.init() )
		.pipe(
			sass({
				errLogToConsole: config.errLogToConsole,
				outputStyle: config.outputStyle,
				precision: config.precision
			})
		)
		.on( 'error', sass.logError )
		.pipe( sourcemaps.write({ includeContent: false }) )
		.pipe( sourcemaps.init({ loadMaps: true }) )
		.pipe( autoprefixer( config.BROWSERS_LIST ) )
		.pipe( sourcemaps.write( './' ) )
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe( gulp.dest( config.styleDestination ) )
		.pipe( filter( '**/*.css' ) ) // Filtering stream to only css files.
		.pipe( mmq({ log: true }) ) // Merge Media Queries only for .min.css version.
		.pipe( browserSync.stream() ) // Reloads style.css if that is enqueued.
		.pipe( rename({ suffix: '.min' }) )
		.pipe( minifycss({ maxLineLen: 10 }) )
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe( gulp.dest( config.styleDestination ) )
		.pipe( filter( '**/*.css' ) ) // Filtering stream to only css files.
		.pipe( browserSync.stream() ) // Reloads style.min.css if that is enqueued.
		.pipe( notify({ message: () => `\n\n✅  ===> STYLES — completed!\n Total size ${s.prettySize}`, onLast: true }) );
});

/**
 * Task: `Admin Styles`.
 *
 * Compiles Sass, Autoprefixes it and Minifies CSS.
 *
 * This task does the following:
 *    1. Gets the source scss file
 *    2. Compiles Sass to CSS
 *    3. Writes Sourcemaps for it
 *    4. Autoprefixes it and generates style.css
 *    5. Renames the CSS file with suffix .min.css
 *    6. Minifies the CSS file and generates style.min.css
 *    7. Injects CSS or reloads the browser via browserSync
 */
gulp.task( 'admin', () => {
	return gulp
		.src( config.styleAdminSRC, { allowEmpty: true })
		.pipe( plumber( errorHandler ) )
		.pipe(
			sass({
				errLogToConsole: config.errLogToConsole,
				outputStyle: config.outputStyle,
				precision: config.precision
			})
		)
		.on( 'error', sass.logError )
		.pipe( autoprefixer( config.BROWSERS_LIST ) )
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe( filter( '**/*.css' ) ) // Filtering stream to only css files.
		.pipe( mmq({ log: true }) ) // Merge Media Queries only for .min.css version.
		.pipe( browserSync.stream() ) // Reloads style.css if that is enqueued.
		.pipe( rename({ suffix: '.min' }) )
		.pipe( minifycss({ maxLineLen: 10 }) )
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe( gulp.dest( config.styleDestination ) )
		.pipe( filter( '**/*.css' ) ) // Filtering stream to only css files.
		.pipe( browserSync.stream() ) // Reloads style.min.css if that is enqueued.
		.pipe( notify({ message: '\n\n✅  ===> ADMIN STYLES — completed!\n', onLast: true }) );
});

/**
 * Task: `Login Styles`.
 *
 * Compiles Sass, Autoprefixes it and Minifies CSS.
 *
 * This task does the following:
 *    1. Gets the source scss file
 *    2. Compiles Sass to CSS
 *    3. Writes Sourcemaps for it
 *    4. Autoprefixes it and generates style.css
 *    5. Renames the CSS file with suffix .min.css
 *    6. Minifies the CSS file and generates style.min.css
 *    7. Injects CSS or reloads the browser via browserSync
 */
gulp.task( 'login', () => {
	return gulp
		.src( config.styleLoginSRC, { allowEmpty: true })
		.pipe( plumber( errorHandler ) )
		.pipe(
			sass({
				errLogToConsole: config.errLogToConsole,
				outputStyle: config.outputStyle,
				precision: config.precision
			})
		)
		.on( 'error', sass.logError )
		.pipe( autoprefixer( config.BROWSERS_LIST ) )
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe( filter( '**/*.css' ) ) // Filtering stream to only css files.
		.pipe( mmq({ log: true }) ) // Merge Media Queries only for .min.css version.
		.pipe( browserSync.stream() ) // Reloads style.css if that is enqueued.
		.pipe( rename({ suffix: '.min' }) )
		.pipe( minifycss({ maxLineLen: 10 }) )
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe( gulp.dest( config.styleDestination ) )
		.pipe( filter( '**/*.css' ) ) // Filtering stream to only css files.
		.pipe( browserSync.stream() ) // Reloads style.min.css if that is enqueued.
		.pipe( notify({ message: '\n\n✅  ===> LOGIN STYLES — completed!\n', onLast: true }) );
});

/**
 * Task: `stylesRTL`.
 *
 * Compiles Sass, Autoprefixes it, Generates RTL stylesheet, and Minifies CSS.
 *
 * This task does the following:
 *    1. Gets the source scss file
 *    2. Compiles Sass to CSS
 *    4. Autoprefixes it and generates style.css
 *    5. Renames the CSS file with suffix -rtl and generates style-rtl.css
 *    6. Writes Sourcemaps for style-rtl.css
 *    7. Renames the CSS files with suffix .min.css
 *    8. Minifies the CSS file and generates style-rtl.min.css
 *    9. Injects CSS or reloads the browser via browserSync
 */
gulp.task( 'stylesRTL', () => {
	return gulp
		.src( config.styleSRC, { allowEmpty: true })
		.pipe( plumber( errorHandler ) )
		.pipe( sourcemaps.init() )
		.pipe(
			sass({
				errLogToConsole: config.errLogToConsole,
				outputStyle: config.outputStyle,
				precision: config.precision
			})
		)
		.on( 'error', sass.logError )
		.pipe( sourcemaps.write({ includeContent: false }) )
		.pipe( sourcemaps.init({ loadMaps: true }) )
		.pipe( autoprefixer( config.BROWSERS_LIST ) )
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe( rename({ suffix: '-rtl' }) ) // Append "-rtl" to the filename.
		.pipe( rtlcss() ) // Convert to RTL.
		.pipe( sourcemaps.write( './' ) ) // Output sourcemap for style-rtl.css.
		//.pipe( gulp.dest( config.styleDestination ) )
		.pipe( filter( '**/*.css' ) ) // Filtering stream to only css files.
		.pipe( browserSync.stream() ) // Reloads style.css or style-rtl.css, if that is enqueued.
		.pipe( mmq({ log: true }) ) // Merge Media Queries only for .min.css version.
		.pipe( rename({ suffix: '.min' }) )
		.pipe( minifycss({ maxLineLen: 10 }) )
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe( gulp.dest( config.styleDestination ) )
		.pipe( filter( '**/*.css' ) ) // Filtering stream to only css files.
		.pipe( browserSync.stream() ) // Reloads style.css or style-rtl.css, if that is enqueued.
		.pipe( notify({ message: '\n\n✅  ===> STYLES RTL — completed!\n', onLast: true }) );
});

/**
 * Task: `headerJS`.
 *
 * Concatenate and uglify vendor JS scripts.
 *
 * This task does the following:
 *     1. Gets the source folder for JS vendor files
 *     2. Concatenates all the files and generates vendors.js
 *     3. Renames the JS file with suffix .min.js
 *     4. Uglifes/Minifies the JS file and generates vendors.min.js
 */
gulp.task( 'headerJS', () => {
	return gulp
		.src( config.jsHeaderSRC, { since: gulp.lastRun( 'headerJS' ) }) // Only run on changed files.
		.pipe( plumber( errorHandler ) )
		.pipe(
			babel({
				presets: [
					[
						'@babel/preset-env', // Preset to compile your modern JS to ES5.
						{
							targets: { browsers: config.BROWSERS_LIST } // Target browser list to support.
						}
					]
				]
			})
		)
		.pipe( remember( config.jsHeaderSRC ) ) // Bring all files back to stream.
		.pipe( concat( config.jsHeaderFile + '.js' ) )
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe(
			rename({
				basename: config.jsHeaderFile,
				suffix: '.min'
			})
		)
		.pipe( uglify() )
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe( gulp.dest( config.jsHeaderDestination ) )
		//.pipe( del( config.jsHeaderDestination + '/' + config.jsHeaderFile + '.js' ) )
		.pipe( notify({ message: '\n\n✅  ===> HEADER JS — completed!\n', onLast: true }) );
});

/**
 * Task: `footerJS`.
 *
 * Concatenate and uglify custom JS scripts.
 *
 * This task does the following:
 *     1. Gets the source folder for JS custom files
 *     2. Concatenates all the files and generates custom.js
 *     3. Renames the JS file with suffix .min.js
 *     4. Uglifes/Minifies the JS file and generates custom.min.js
 */
gulp.task( 'footerJS', () => {
	return gulp
		.src( config.jsFooterSRC, { since: gulp.lastRun( 'footerJS' ) }) // Only run on changed files.
		.pipe( plumber( errorHandler ) )
		.pipe(
			babel({
				presets: [
					[
						'@babel/preset-env', // Preset to compile your modern JS to ES5.
						{
							targets: { browsers: config.BROWSERS_LIST } // Target browser list to support.
						}
					]
				]
			})
		)
		.pipe( remember( config.jsFooterSRC ) ) // Bring all files back to stream.
		.pipe( concat( config.jsFooterFile + '.js' ) )
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe(
			rename({
				basename: config.jsFooterFile,
				suffix: '.min'
			})
		)
		.pipe( uglify() )
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe( gulp.dest( config.jsFooterDestination ) )
		.pipe( notify({ message: '\n\n✅  ===> FOOTER JS — completed!\n', onLast: true }) );
});
/**
 * Task: `adminJS`.
 *
 * Concatenate and uglify custom JS scripts.
 *
 * This task does the following:
 *     1. Gets the source folder for JS custom files
 *     2. Concatenates all the files and generates custom.js
 *     3. Renames the JS file with suffix .min.js
 *     4. Uglifes/Minifies the JS file and generates custom.min.js
 */
gulp.task( 'adminJS', () => {
	return gulp
		.src( config.jsAdminSRC, { since: gulp.lastRun( 'adminJS' ) }) // Only run on changed files.
		.pipe( plumber( errorHandler ) )
		.pipe(
			babel({
				presets: [
					[
						'@babel/preset-env', // Preset to compile your modern JS to ES5.
						{
							targets: { browsers: config.BROWSERS_LIST } // Target browser list to support.
						}
					]
				]
			})
		)
		.pipe( remember( config.jsAdminSRC ) ) // Bring all files back to stream.
		.pipe( concat( config.jsAdminFile + '.js' ) )
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe(
			rename({
				basename: config.jsAdminFile,
				suffix: '.min'
			})
		)
		.pipe( uglify() )
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe( gulp.dest( config.jsAdminDestination ) )
		.pipe( notify({ message: '\n\n✅  ===> ADMIN JS — completed!\n', onLast: true }) );
});

/**
 * Task: `loginJS`.
 *
 * Concatenate and uglify custom JS scripts.
 *
 * This task does the following:
 *     1. Gets the source folder for JS custom files
 *     2. Concatenates all the files and generates custom.js
 *     3. Renames the JS file with suffix .min.js
 *     4. Uglifes/Minifies the JS file and generates custom.min.js
 */
gulp.task( 'loginJS', () => {
	return gulp
		.src( config.jsLoginSRC, { since: gulp.lastRun( 'loginJS' ) }) // Only run on changed files.
		.pipe( plumber( errorHandler ) )
		.pipe(
			babel({
				presets: [
					[
						'@babel/preset-env', // Preset to compile your modern JS to ES5.
						{
							targets: { browsers: config.BROWSERS_LIST } // Target browser list to support.
						}
					]
				]
			})
		)
		.pipe( remember( config.jsLoginSRC ) ) // Bring all files back to stream.
		.pipe( concat( config.jsLoginFile + '.js' ) )
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe(
			rename({
				basename: config.jsLoginFile,
				suffix: '.min'
			})
		)
		.pipe( uglify() )
		.pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
		.pipe( gulp.dest( config.jsLoginDestination ) )
		.pipe( notify({ message: '\n\n✅  ===> LOGIN JS — completed!\n', onLast: true }) );
});

/**
 * Task: `images`.
 *
 * Minifies PNG, JPEG, GIF and SVG images.
 *
 * This task does the following:
 *     1. Gets the source of images raw folder
 *     2. Minifies PNG, JPEG, GIF and SVG images
 *     3. Generates and saves the optimized images
 *
 * This task will run only once, if you want to run it
 * again, do it with the command `gulp images`.
 *
 * Read the following to change these options.
 * @link https://github.com/sindresorhus/gulp-imagemin
 */
gulp.task( 'images', () => {
	return gulp
		.src( config.imgSRC )
		.pipe(
			cache(
				imagemin([
					imagemin.gifsicle({ interlaced: true }),
					imagemin.jpegtran({ progressive: true }),
					imagemin.optipng({ optimizationLevel: 3 }), // 0-7 low-high.
					imagemin.svgo({
						plugins: [ { removeViewBox: true }, { cleanupIDs: false } ]
					})
				])
			)
		)
		.pipe( gulp.dest( config.imgDST ) )
		.pipe( notify({ message: '\n\n✅  ===> IMAGES — completed!\n', onLast: true }) );
});


/**
 * Task `fonts`.
 * 
 * Moves Fonts Folder to Theme Folder and reruns ever time new Fonts are added
 * 
 */
gulp.task( 'fonts', () => {
	return gulp
		.src( config.fontsSRC )
		.pipe( plumber( errorHandler ) )
		.pipe( gulp.dest( config.fontsDestination ) )
		.pipe( notify({ message: '\n\n✅  ===> FONTS — completed!\n', onLast: true }) );
});

/**
 * Task: `svg-sprite`.
 * 
 * Create a SVG Sprite File with all SVG Icons from Icons Folder
 * 
 */

gulp.task('svgIcons', () => {
    return gulp
        .src( config.iconSRC )
        .pipe(svgmin(function (file) {
            var prefix = path.basename(file.relative, path.extname(file.relative));
            return {
                plugins: [{
                    cleanupIDs: {
                        prefix: prefix + '-',
                        minify: true
                    }
                }]
            }
        }))
        .pipe(svgstore({ inlineSvg: true }))
        .pipe(cheerio({
            run: function ($) {
                $('svg').attr('style',  'position: absolute; width: 0; height: 0; overflow: hidden;');
            },
            parserOptions: { xmlMode: true }
        }))
        .pipe(rename( config.iconFilename + '.svg'))
		.pipe(gulp.dest( config.iconDestination ))
		.pipe( notify({ message: '\n\n✅  ===> ICONS — completed!\n', onLast: true }) );
});


/**
 * Task: `clear-images-cache`.
 *
 * Deletes the images cache. By running the next "images" task,
 * each image will be regenerated.
 */
gulp.task( 'clearCache', function( done ) {
	return cache.clearAll( done );
});

/**
 * WP POT Translation File Generator.
 *
 * This task does the following:
 * 1. Gets the source of all the PHP files
 * 2. Sort files in stream by path or any custom sort comparator
 * 3. Applies wpPot with the variable set at the top of this file
 * 4. Generate a .pot file of i18n that can be used for l10n to build .mo file
 */
gulp.task( 'translate', () => {
	return gulp
		.src( config.watchPhp )
		.pipe( sort() )
		.pipe(
			wpPot({
				domain: config.textDomain,
				package: config.packageName,
				bugReport: config.bugReport,
				lastTranslator: config.lastTranslator,
				team: config.team
			})
		)
		.pipe( gulp.dest( config.translationDestination + '/' + config.translationFile ) )
		.pipe( notify({ message: '\n\n✅  ===> TRANSLATE — completed!\n', onLast: true }) );
});

/**
 * Build Dist Build and get ready for Deployment
 * 
 * Must run manually with gulp build
 */

async function cleanDist() {
	await del([ config.buildDestination ]);
}

function copyThemeDist() {
	return gulp
		.src([ config.styleDestination + '/**' ])
		.pipe( gulp.dest( config.buildDestination + '/' + config.projectName ))
		.pipe( notify({ message: '\n\n✅  ===> DIST — completed!\n', onLast: true }) );
}

exports.dist = gulp.series(
	cleanDist,
	copyThemeDist
);


/**
 * Watch Tasks.
 *
 * Watches for file changes and runs specific tasks.
 */
gulp.task(
	'default',
	gulp.parallel( 'theme', 'styles', 'admin', 'login', 'headerJS', 'footerJS', 'adminJS', 'loginJS', 'images', 'svgIcons', 'fonts', browsersync, () => {
		gulp.watch( config.watchPhp, reload ); // Reload on PHP file changes.
		gulp.watch( config.watchTheme, gulp.parallel( 'theme', reload ) ); // Reload Theme file changes.
		gulp.watch( config.watchStyles, gulp.parallel( 'styles', 'admin', 'login' ) ); // Reload on SCSS file changes.
		gulp.watch( config.watchJSHeader, gulp.series( 'headerJS', reload ) ); // Reload on headerJS file changes.
		gulp.watch( config.watchJSFooter, gulp.series( 'footerJS', reload ) ); // Reload on footerJS file changes.
		gulp.watch( config.watchJSAdmin, gulp.series( 'adminJS', reload ) ); // Reload on adminJS file changes.
		gulp.watch( config.watchJSLogin, gulp.series( 'loginJS', reload ) ); // Reload on loginJS file changes.
		gulp.watch( config.imgSRC, gulp.series( 'images', reload ) ); // Reload on footerJS file changes.
		gulp.watch( config.iconSRC, gulp.series( 'svgIcons', reload ) ); // Reload on footerJS file changes.
		gulp.watch( config.fontsSRC, gulp.series( 'fonts', reload ) ); // Reload on footerJS file changes.
	})
);