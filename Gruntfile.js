var path = require('path')

module.exports = function (grunt) {
    // Project configuration.
    grunt.initConfig({
        cssmin: {
            options: {
                keepSpecialComments: 0
            },
            wp: {
                files: {
                    'style.css': 'style.css'
                }
            }
        },
        sass: {
            options: {
                importer: function (url, prev, done) {
                    if (url[0] === '~') {
                        url = path.resolve('node_modules', url.substr(1))
                    }

                    return { file: url }
                }
            },
            wp: {
                files: {
                    'style.css': 'scss/main.scss'
                }
            }
        },
        uglify: {
            wp: {
                files: {
                    'scripts.min.js': [
                        'node_modules/match-media/matchMedia.js',
                        'js/main.js'
                    ]
                }
            }
        },
        watch: {
            sass: {
                files: ['scss/**/*.scss'],
                tasks: ['sass']
            },
            uglify: {
                files: ['js/**/*.js'],
                tasks: ['uglify']
            }
        },
        browserSync: {
            dev: {
                bsFiles: {
                    src : [
                        '**/*.php',
                        'scripts.min.js',
                        'style.css'
                    ]
                },
                options: {
                    watchTask: true,
                    proxy: "demenuenmenu.com:8080"
                }
            }
        }
    })

    // Load plugins used by this task gruntfile
    grunt.loadNpmTasks('grunt-contrib-cssmin')
    grunt.loadNpmTasks('grunt-contrib-uglify')
    grunt.loadNpmTasks('grunt-contrib-watch')
    grunt.loadNpmTasks('grunt-sass')
    grunt.loadNpmTasks('grunt-browser-sync')

    // Task definitions
    grunt.registerTask('build-dev', ['sass', 'uglify'])
    grunt.registerTask('build-prod', ['sass', 'cssmin', 'uglify'])
    grunt.registerTask('dev', ['build-dev', 'browserSync', 'watch'])
    grunt.registerTask('default', ['dev'])
}
