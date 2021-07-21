import "./styles/admin.scss"
import InputAttachment from "/Elements/admin/InputAttachment";
import FileManager from "/Elements/admin/filemanager";
import { ModalDialog} from '@sb-elements/all'

customElements.define('modal-dialog', ModalDialog)
customElements.define('input-attachment', InputAttachment, { extends: 'input' })
customElements.define('file-manager', FileManager)