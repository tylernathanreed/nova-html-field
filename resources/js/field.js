Nova.booting((Vue, router, store) => {
    Vue.component('index-html-field', require('./components/Field'))
    Vue.component('detail-html-field', require('./components/Field'))
    Vue.component('form-html-field', require('./components/Field'))
})
