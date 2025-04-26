import './bootstrap';
import 'flowbite';
import flatpickr from 'flatpickr';
import "flatpickr/dist/flatpickr.min.css";
import './gxui/pagination'
import './gxui/file-dropper'
import './gxui/toast'
import './gxui/popper'
import './gxui/select'
import './gxui/datepicker'
import './gxui/table'
import './gxui/loader'
import './gxui/modal'
import TABLE_STORE from "./gxui/const/table-store";
import Dropzone from "dropzone";
import "dropzone/dist/dropzone.css";
Dropzone.autoDiscover = false;
window.Dropzone = Dropzone;
window.TableStore = TABLE_STORE;
