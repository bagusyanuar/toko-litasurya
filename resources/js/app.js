import './bootstrap';
import 'flowbite';
import './gxui/pagination'
import './gxui/file-dropper'
import './gxui/toast'
import './gxui/popper'
import './gxui/select'
import TABLE_STORE from "./gxui/const/table-store";
import Dropzone from "dropzone";
import "dropzone/dist/dropzone.css";
Dropzone.autoDiscover = false;
window.Dropzone = Dropzone;
window.TableStore = TABLE_STORE;
