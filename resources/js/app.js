

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Medium = require('medium-editor');
window.ready = function() {
    var editor = new Medium('.editable');
    editor.pasteHtml('{{ $beitrag->html }}');
}

// window.Vue = require('vue');

// import Vuetify from 'vuetify'

// import 'vuetify/dist/vuetify.min.css'

// Vue.use(Vuetify)
// const vuetify = new Vuetify({
//     theme: { dark: true },
//     icons: {
//         iconfont: 'mdi',
//     },
// })


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
// const app = new Vue({
//     el: '#app',
//     vuetify: vuetify,
// });

