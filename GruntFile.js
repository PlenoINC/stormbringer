module.exports = function(grunt) {

  // 1. All configuration goes here
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    // Combine our javascript files into one
    concat: {
      dist: {
        src: [
          'js/common.js',   // Common
          'js/bootstrap-loadimage.js',   // Bootstrap Image Load
          'js/bootstrap-modalgallery.js',   // Bootstrap Modal Gallery
          'js/bootstrap-modalopen.js',   // Bootstrap Modal
          'js/app.js',   // Custom JS
        ],
        dest: 'assets/javascripts/production.js',
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

    shell: {
      grunt: {
        command: 'afplay ~/Music/Grunt.aiff'
      }
    },

    watch: {
      options: {
        livereload: true,
      },

      scripts: {
        files: ['assets/javascripts/*.js'],
        tasks: ['concat', 'uglify', 'shell:grunt'],
        options: {
          spawn: false,
        },
      },

      css: {
        files: ['assets/stylesheets/*.scss'],
        tasks: ['sass', 'cssmin', 'shell:grunt'],
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
  grunt.loadNpmTasks('grunt-autoprefixer');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-shell');


  // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
  grunt.registerTask('default', ['concat', 'uglify', 'sass', 'cssmin', 'autoprefixer', 'watch', 'shell']);

};
