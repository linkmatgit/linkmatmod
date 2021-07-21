import Button from './Button'
import { strToDom } from '../../../functions/dom.js'

export default class FullScreenButton extends Button {
    constructor (editor) {
        super(editor)
        this.isFullscreen = false
    }

    icon () {
        this.icon = strToDom(
            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style={style}><path d="M352.201 425.775l-79.196 79.196c-9.373 9.373-24.568 9.373-33.941 0l-79.196-79.196c-15.119-15.119-4.411-40.971 16.971-40.97h51.162L228 284H127.196v51.162c0 21.382-25.851 32.09-40.971 16.971L7.029 272.937c-9.373-9.373-9.373-24.569 0-33.941L86.225 159.8c15.119-15.119 40.971-4.411 40.971 16.971V228H228V127.196h-51.23c-21.382 0-32.09-25.851-16.971-40.971l79.196-79.196c9.373-9.373 24.568-9.373 33.941 0l79.196 79.196c15.119 15.119 4.411 40.971-16.971 40.971h-51.162V228h100.804v-51.162c0-21.382 25.851-32.09 40.97-16.971l79.196 79.196c9.373 9.373 9.373 24.569 0 33.941L425.773 352.2c-15.119 15.119-40.971 4.411-40.97-16.971V284H284v100.804h51.23c21.382 0 32.09 25.851 16.971 40.971z"/></svg>'
        )
        return this.icon
    }

    /**
     * @param {Editor} editor
     */
    action () {
        this.isFullscreen = !this.isFullscreen
        this.icon.style.fill = this.isFullscreen ? '#8BC34A' : null
    }
}