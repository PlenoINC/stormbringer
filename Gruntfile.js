module.exports = function(grunt) {

  // 1. All configuration goes here
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    // Clean old files
    clean: {
      js: ['js/production.min.*.js', '!js/production.min.'+grunt.template.today('yyyymm')+'*.js'],
      css: ['css/application.min.*.js', '!css/application.min.'+grunt.template.today('yyyymm')+'*.css']
    },

    // Versioning
    assets_versioning: {
      deployment: {
        options: {
          dateFormat: 'YYYYMMDDHH',
          tag: 'date',
          versionsMapFile: 'inc/front/gruntassets.php',
          versionsMapTemplate: 'inc/front/gruntassets.tpl',
        },
        files: {
          'css/application.min.css': [ 'css/application.min.css'],
          'js/production.min.js': [ 'js/production.min.js'],
        }
      }
    },

    // Combine our javascript files into one
    concat: {
      dist: {
        src: [
          'js/common.js',   // Common
          'js/bootstrap-modalgallery.js',   // Bootstrap Modal Gallery
          'js/bootstrap-modalopen.js',   // Bootstrap Modal
          'js/application.js',   // Custom JS
        ],
        dest: 'js/production.js',
      }
    },

    // Minify javascript
    uglify: {
      build: {
        src: 'js/production.js',
        dest: 'js/production.min.js'
      }
    },

    sass: {
      dist: {
        options: {
          style: 'expanded'
        },
        files: {
          'css/application.css': 'scss/application.scss'
        }
      }
    },


    cssmin: {
      combine: {
        files: {
          'css/application.min.css': ['css/application.css']
        }
      }
    },

    watch: {
      options: {
        livereload : 35729,
      },

      scripts: {
        files: ['js/*.js'],
        tasks: ['concat', 'uglify', 'clean', 'assets_versioning'],
        options: {
          spawn: false,
        },
      },

      css: {
        files: ['scss/*.scss', 'scss/bootstrap/*.scss', 'scss/helpers/*.scss'],
        tasks: ['sass', 'cssmin', 'clean', 'assets_versioning'],
        options: {
          spawn: false,
        }
      },

    }

  });

  // 3. Where we tell Grunt we plan to use this plug-in.
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-assets-versioning');
  grunt.loadNpmTasks('grunt-contrib-clean');


  // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
  grunt.registerTask('default', ['concat', 'uglify', 'sass', 'cssmin', 'watch', 'assets_versioning', 'clean']);

};
