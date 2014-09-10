module.exports = function (grunt) {
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        compass: {
            dist: {
                options: {
                    'output-style': 'compressed',
                    'sass-dir': 'sass',
                    'css-dir': 'css'
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
                    'js/libs/modernizr/modernizr.js',
                    'js/libs/respond/src/respond.js',
                ],
                dest: 'js/build/head.js',
            },
            main: {
                src: [
                    'js/libs/bootstrap-sass-official/assets/javascripts/bootstrap.js',
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
                tasks: ['compass:dist']
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

    grunt.loadNpmTasks('grunt-contrib-compass');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', ['copy', 'watch']);
};
