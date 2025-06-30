//Project settings
const potFile = "fairbase";
const projectName = "fairbase";

//Gulp requirements
const { src, dest, series, parallel, watch } = require("gulp");
const sass = require("gulp-sass")(require('sass'));
const uglifycss = require("gulp-uglifycss");

let autoprefixer;
import('gulp-autoprefixer').then((module) => {
	autoprefixer = module;
});

const imagemin = require("gulp-imagemin");
const cache = require("gulp-cache");
const uglifyEs = require("gulp-uglify-es").default;
const babel = require("gulp-babel");
const livereload = require("gulp-livereload");
const wpPot = require('gulp-wp-pot');
const sassLint = require('gulp-sass-lint');
const fontello = require('gulp-fontello');
const concat = require('gulp-concat');
const clean = require('gulp-clean');

//Path variables
const srcPath = "web/src";
const distPath = "web/dist";

//Path array
const paths = {
	scss: [`${srcPath}/scss/**/*.scss`],
	js: [`${srcPath}/scripts/**/*.js`],
	img: [`${srcPath}/images/**`],
	font: [`${srcPath}/font/**`],
	jsvendor: [`${srcPath}/scripts/vendor/*.js`],
};

// CSS task
async function css() {
	const autoprefixer = await import('gulp-autoprefixer');

	return src(paths.scss)
		.pipe(sassLint({
			options: {
				formatter: 'stylish'
			},
			configFile: 'sass-lint.yml'
		}))
		.pipe(sassLint.format())
		.pipe(sassLint.failOnError())
		.pipe(sass())
		.pipe(
			autoprefixer.default({
				overrideBrowserslist: ["last 2 versions"],
				cascade: false,
			})
		)
		.pipe(uglifycss())
		.pipe(dest(`${distPath}/css/`))
		.pipe(livereload());
}


// Javascript task
function js() {
	return src(paths.js)
		.pipe(
			babel({
				presets: ["@babel/preset-env"],
			})
		)
		.pipe(uglifyEs())
		.pipe(concat('scripts.min.js'))
		.pipe(dest(`${distPath}/scripts/`))
		.pipe(livereload());
}

// Javascript vendor files
function jsVendor() {
	return src(paths.jsvendor)
		.pipe(dest(`${distPath}/scripts/vendor/`))
		.pipe(livereload());
}

// Font task
function font() {
	return src(paths.font)
		.pipe(dest(`${distPath}/font/`))
		.pipe(livereload());
}

// Image task
function img() {
	return src(paths.img)
		.pipe(
			cache(
				imagemin({
					interlaced: true,
				})
			)
		)
		.pipe(dest(`${distPath}/images/`))
		.pipe(livereload());
}

// WordPress internationalization
function wpPotTask() {
	return src('web/**/*.php')
		.pipe(wpPot({
			domain: "TEXTDOMAIN",  // Looks for TEXTDOMAIN global PHP var.
			package: projectName
		}))
		.pipe(dest(langPath + "/" + potFile + ".pot"))
		.pipe(livereload());
}

// Clean task
function cleantask() {
	return src(`${distPath}/*`, { read: false, allowEmpty: true })
		.pipe(clean());
}

// Watch task
function watchFiles() {
	livereload.listen();
	watch(paths.scss, css);
	watch(paths.js, js);
	watch(paths.img, img);
	watch(paths.font, font);
	watch(paths.jsvendor, jsVendor);
}

exports.watch = watchFiles;


exports.default = series(cleantask, parallel(css, js, font, img, jsVendor));
