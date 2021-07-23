import preactCustomElement from '/functions/preact.js'
import {WorksDelete} from "/Elements/works/WorksDelete";
import {WorkCreateMessage} from "/Elements/works/WorkCreateMessage";

preactCustomElement('work-delete', WorksDelete)
preactCustomElement('work-createmessage', WorkCreateMessage, ['topic', 'disabled'])