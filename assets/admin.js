import "./css/admin.scss"
import InputAttachment from "/Elements/admin/InputAttachment";
import FileManager from "/Elements/admin/filemanager";
import { ModalDialog} from '@sb-elements/all'
import { DiffEditor } from '/Elements/DiffEditor.jsx'
import preactCustomElement from './functions/preact'

customElements.define('modal-dialog', ModalDialog)
customElements.define('input-attachment', InputAttachment, { extends: 'input' })
customElements.define('file-manager', FileManager)
customElements.define('diff-editor', DiffEditor, { extends: 'textarea' })