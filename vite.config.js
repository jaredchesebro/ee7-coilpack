import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { viteStaticCopy } from 'vite-plugin-static-copy'
import fullReload from 'vite-plugin-full-reload'

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/scss/main.scss', 'resources/js/main.js'],
            refresh: true,
        }),
        /**
         * Static Asset Copying
         *
         * Copies static files from resources/ to public/dist/ during build.
         * Add your fonts and images to resources/fonts/ and resources/images/.
         * They'll be available at /dist/fonts/ and /dist/images/ in the browser.
         */
        /*
        viteStaticCopy({
            targets: [
                {
                    src: 'resources/fonts/*',    // Source: resources/fonts/*
                    dest: 'fonts'                // Destination: public/build/fonts/
                },
                {
                    src: 'resources/images/*',   // Source: resources/images/*
                    dest: 'images'               // Destination: public/build/images/
                }
            ]
        }),
        */
        /**
		* Template File Watching
		*
		* Watches CMS front-end templates and triggers full page reload on changes.
		* Excludes _variables/ directory to reduce unnecessary reloads.
		*/
		fullReload([
			'ee/system/user/templates/**/*.html',
			'!ee/system/user/templates/**/_variables/**'
		])
    ],
    build: {
        sourcemap: false,
    },
    css: {
        devSourcemap: true,
        // SCSS preprocessor options
        preprocessorOptions: {
            scss: {
            /**
             * Silence Bootstrap's deprecation warnings
             *
             * Bootstrap 5 uses legacy Sass features that trigger warnings.
             * These will be fixed when Bootstrap 6 releases.
             * Safe to silence for now - doesn't affect functionality.
             */
            silenceDeprecations: [
                'import',           // @import is deprecated (use @use/@forward)
                'color-functions',  // red(), green(), blue() deprecated
                'global-builtin',   // Global functions like mix() deprecated
                'legacy-js-api',    // Old JavaScript API usage
            ],
            },
        },
    },
    server: {
        host: '0.0.0.0',
        strictPort: true,
        port: 5173,
        hmr: {
            protocol: 'wss',
            host: process.env.DDEV_HOSTNAME || 'localhost',
            clientPort: 5173,
        },
        watch: {
            usePolling: true,
        },
    },
});
