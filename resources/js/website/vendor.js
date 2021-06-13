/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('@fancyapps/fancybox');
import Swiper from 'swiper/bundle';
import Swal from 'sweetalert2';
window.Swiper = Swiper;
window.Swal = Swal;
window.Cookies = require('js-cookie');
window.bootbox = require('bootbox');

require('../plugins/gmaps.js');
require('../plugins/jquery.maCookieEu.js');

