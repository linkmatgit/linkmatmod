import React from 'react'
import { SketchPicker } from 'react-color';
export default class ColorPicker extends HTMLInputElement{

    constructor() {
        super();
    }

    connectedCallBack(){
        render(<SketchPicker />)

    }
}