module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        sass: {
            options: {
                sourceMap: true,
                outputStyle: 'compressed',
                includePaths: [
                    'libs',
                    'libs/fontawesome/scss',
                    'libs/bootstrap-sass/assets/stylesheets'
                ]
            },
            dist: {
                files: {
                    'css/main.css': 'sass/main.scss',
                    'css/print.css': 'sass/print.scss'
                }
            }
        },
        jshint: {
            options: {
                'browser': true,
                'curly': true,
                'eqeqeq': true,
                'indent': 4,
                'latedef': true,
                'nonbsp': true,
                'plusplus': true,
                'quotmark': 'single',
                'undef': true
            },
            default: ['js/*.js']
        },
        concat: {
            head: {
                src: [
                    'js/head.js',
                    'libs/modernizr/modernizr.js',
                    'libs/respond/src/respond.js',
                ],
                dest: 'js/build/head.js',
            },
            main: {
                src: [
                    'libs/bootstrap-sass-official/assets/javascripts/bootstrap.js',
                    'js/main.js'
                ],
                dest: 'js/build/main.js',
            }
        },
        uglify: {
            head: {
                src: 'js/build/head.js',
                dest: 'js/build/head.min.js'
            },
            main: {
                src: 'js/build/main.js',
                dest: 'js/build/main.min.js'
            }
        },
        copy: {
            main: {
                files: [
                    {expand: true, cwd: 'js/libs/fontawesome/fonts', src: ['*'], dest: 'fonts/'}
                ]
            }
        },
        watch: {
            sass: {
                files: 'sass/*.scss',
                tasks: ['sass:dist'],
                options: {
                    livereload: true
                }
            },
            scripts: {
                files: ['js/*.js'],
                tasks: ['jshint', 'concat', 'uglify'],
                options: {
                    spawn: false,
                    livereload: true
                }
            }
        }
    });

    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', ['copy', 'watch']);
};
