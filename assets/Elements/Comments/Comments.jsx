import {render} from 'react-dom'
import React, {useEffect} from 'react'
import {Comments} from "../../Components/Comments";


class CommentsElement extends HTMLElement {

    constructor() {
        super()
        this.observer =  null
    }
    connectedCallback(){

        const post = parseInt(this.dataset.post, 10)
        const user = parseInt(this.dataset.user, 10) || null
        if(this.observer === null){
            this.observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if(entry.isIntersecting && entry.target === this){
                        observer.disconnect()
                        render(<Comments post={post} user={user}/>, this)
                    }
                })
            })
        }
        this.observer.observe(this)
    }

    disconnectedCallback(){
        if(this.observer) {
            this.observer.disconnect()
        }
    }
}
customElements.define('comment-module', CommentsElement)