/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

require('@fancyapps/fancybox');
import Swiper from 'swiper/bundle';

window.Swiper = Swiper;
require('smokejs/dist/js/smoke.min.js');
window.Cookies = require('js-cookie');
window.bootbox = require('bootbox');

require('../plugins/gmaps.js');
require('../plugins/jquery.maCookieEu.js');
require('../plugins/jquery.pb-scroll-trigger.js');
