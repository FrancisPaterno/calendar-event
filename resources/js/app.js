require('./bootstrap');

import Vue from 'vue'
import App from './components/app'
import 'bootstrap'
import 'bootstrap/dist/css/bootstrap.min.css'
import '../css/app.css'

const app = new Vue(
    {
        el:'#app',
        components:{ App }
    }
)

