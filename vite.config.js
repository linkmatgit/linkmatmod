import { defineConfig } from 'vite'
import reactRefresh from '@vitejs/plugin-react-refresh'
import {resolve} from 'path'

const twigRefreshPlugin = {
    name: 'twig-refresh',
    configureServer ({watcher, ws}) {
        watcher.add (resolve ('templates / ** / *. twig'))
        watcher.on ('change', function (path) {
            if (path.endsWith ('. twig')) {
                ws.send ({
                    type: 'full-reload'
                })
            }
        })
    }
}
// https://vitejs.dev/config/
export default defineConfig({
    plugins: [reactRefresh(), twigRefreshPlugin],
    root: './assets',
    base: '/assets',
    server: {
        watch: {
            disableGlobbing: false, // required for the twig plugin
        }
    },
    build: {
        manifest: true,
        outDir:'../public/assets',
        assetsDir:'',
        rollupOptions:{
            output: {
                manualChunks: undefined
            },
            input:{
                'app.js': './assets/app.js'
            }
        }
    }
})