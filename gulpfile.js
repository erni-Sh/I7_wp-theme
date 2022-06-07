const gulp = require('gulp'),
      sass = require('gulp-sass'),
      browserSync = require('browser-sync').create(),
      rename = require('gulp-rename'),
      pug = require('gulp-pug'),
      autoprefixer = require('gulp-autoprefixer'),
      sourcemaps = require('gulp-sourcemaps'),
      notify = require('gulp-notify'),
      uglify = require('gulp-uglify'),
      concat = require('gulp-concat'),
      wait = require('gulp-wait'),
      gutil = require('gutil'),
      ftp = require('vinyl-ftp'),
      keys = require('./config_secret.js');


gulp.task('scss', function(){
  return gulp.src('app/scss/styles.scss')
    .pipe(sourcemaps.init())
    .pipe(wait(1500))
    .pipe(sass({outputStyle: 'compressed', includePaths: ['node_modules']}).on('error', notify.onError({
        message: "Error: <%= error.message %>",
        title: "SASS ERROR"
    })))
    .pipe(autoprefixer({
        overrideBrowserslist: ['last 8 versions']
      }))
    .pipe(rename({suffix: '.min'}))
    .pipe(sourcemaps.write('.', {includeContent: false, sourceRoot: 'static/css'}))
    .pipe(gulp.dest('i7_theme/css'))
    .pipe(browserSync.reload({stream: true}))
});

gulp.task('pug', function(){
  return gulp.src(['app/pug/**/*.pug', '!app/pug/includes/**/*'])
    .pipe(pug({pretty: true}).on('error', notify.onError({
        message: "Error: <%= error.message %>",
        title: "PUG ERROR"
    })))
    .pipe(rename({ extname: '.php' }))
    .pipe(gulp.dest('i7_theme/'))
    .pipe(browserSync.reload({stream: true}))
});

gulp.task('pug-local', function(){
  return gulp.src('app/local-dev/*.pug')
    .pipe(pug({pretty: true}).on('error', notify.onError({
        message: "Error: <%= error.message %>",
        title: "PUG ERROR"
    })))
    .pipe(gulp.dest('i7_theme/'))
    .pipe(browserSync.reload({stream: true}))
});

gulp.task('js', function () {
  return gulp.src([
    'app/js/libs/jquery-3.3.1.min.js',
    // 'app/js/libs/jquery.waypoints.min.js',
    'app/js/libs/swiper-bundle.min.js',
    // 'app/js/libs/jquery.matchHeight-min.js',
    // 'app/js/libs/ScrollMagic.min.js',
    // 'app/js/libs/owl.carousel.min.js',
    // 'app/js/libs/TweenMax.min.js',
    // 'app/js/libs/gsap.min.js',
    // 'app/js/libs/ScrollTrigger.min.js',
    // 'node_modules/jquery.maskedinput/src/jquery.maskedinput.js',
    'app/js/custom.js'
  ])
    // .pipe(uglify())
    .pipe(concat('custom.js'))
    .pipe(gulp.dest('i7_theme/js'));
});


gulp.task('browser-sync', function() {
  browserSync.init({
      server: {
          baseDir: "i7_theme/",
          routes : {
            '/node_modules' : './node_modules'
        }
      }
  });
});

gulp.task( 'deploy', function () {
 
    var conn = ftp.create({
        host:     keys.host,
        port:     keys.port,
        user:     keys.user,
        password: keys.password,
        parallel: 10,
        timeOffset: 120, // смещение часового пояса сервера
        log:      gutil.log
    });
 
    var globs = [ // запрет на синхронизацию
        'i7_theme/**',
        
        '!i7_theme/**.html',

        '!i7_theme/elements/**',
        '!i7_theme/fonts/**',
        '!i7_theme/img/**',

        '!i7_theme/sections/**',
        '!i7_theme/footer.php',
        '!i7_theme/functions.php',
        '!i7_theme/functions(backup).php',
        '!i7_theme/header.php',
        '!i7_theme/index.php',
        '!i7_theme/news-inside.php',
        '!i7_theme/page-about-us.php',

        '!i7_theme/page-cart.php',
        '!i7_theme/page-checkout.php',
        '!i7_theme/page-consolidation.php',
        '!i7_theme/page-products.php',
        '!i7_theme/page-shop.php',

        '!i7_theme/page-brands.php',
        '!i7_theme/page-solutions.php',
        '!i7_theme/page-support.php',
        '!i7_theme/screenshot.png',
        '!i7_theme/search.php',
        '!i7_theme/single-post.php',
        '!i7_theme/single-product.php',

        '!i7_theme/template-docs.php',        


        '!i7_theme/woocommerce/**',        
        '!i7_theme/style.css',

        // '!i7_theme/css/**',
        '!i7_theme/js/**',

        '!sftp-config.json',
    ];
    // using base = '.' will transfer everything to /public_html correctly
    return gulp.src( globs, { base: '.', buffer: false } )
        .pipe( conn.newer( '/iseven.ru/www/wp-content/themes/' )) // only upload newer files
        .pipe( conn.dest( '/iseven.ru/www/wp-content/themes/' ) )
        .pipe(notify({
          message: "Да ты крут, чувак)",
          title: "ЗАГРУЖЕНО НА СЕРВЕР!",
          onLast: true
        }));
});

gulp.task('watch', function(){
  gulp.watch('app/scss/**/*.scss', gulp.series('scss','deploy'));
  gulp.watch('app/pug/**/*.pug', gulp.series('pug','deploy'));
  gulp.watch('app/js/**/*.js', gulp.series('js','deploy'));
});

gulp.task('watch-local', function(done){
  gulp.watch('app/scss/**/*.scss', gulp.series('scss'));
  gulp.watch('app/local-dev/**/*.pug', gulp.series('pug-local'));
  gulp.watch('app/js/**/*.js', gulp.series('js'));
  done();
});

// -------------------------------------------------
gulp.task('default', gulp.series('scss', 'pug', 'js', 'deploy', 'watch'))

gulp.task('local', gulp.series('scss', 'pug-local', 'js', 'watch-local', 'browser-sync'))