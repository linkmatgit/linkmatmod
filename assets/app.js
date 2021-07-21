import '/styles/app.scss'
import SpinningDots from "/Elements/Loader";
import {InputChoices, SelectChoices} from "/Elements/Choices";
import {Switch} from "/Elements/Switch";
import {TimeAgo} from "/Elements/TimeAgo";
import {DatePicker} from "/Elements/DatePicker";
import {Autogrow} from "/Elements/Autogrow";
import {MarkdownEditor} from "/Elements/editor";
import {NavTabs} from "@sb-elements/all";
import {Alert, FloatingAlert} from "/Elements/Alert";
import ColorPicker from "/Elements/ColorPicker";
import {Dropdown} from "/Elements/Dropdown";

customElements.define('alert-message', Alert)
customElements.define('alert-floating', FloatingAlert)
customElements.define('nav-tabs', NavTabs)
customElements.define('time-ago', TimeAgo)
customElements.define('spinning-dots', SpinningDots)
customElements.define('input-choices', InputChoices, { extends: 'input' })
customElements.define('select-choices', SelectChoices, { extends: 'select' })
customElements.define('input-switch', Switch, { extends: 'input' })
customElements.define('date-picker', DatePicker, { extends: 'input' })
customElements.define('textarea-autogrow', Autogrow,{ extends: 'textarea' })
customElements.define('markdown-editor', MarkdownEditor, { extends: 'textarea' })
customElements.define('drop-down', Dropdown)
customElements.define('color-picker', ColorPicker, { extends: 'input' })

