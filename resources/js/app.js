import './bootstrap';
import 'flowbite';
import './gxui/pagination'
import './gxui/file-dropper'
import './gxui/toast'
import Dropzone from "dropzone";
import "dropzone/dist/dropzone.css";
Dropzone.autoDiscover = false;
window.Dropzone = Dropzone;
