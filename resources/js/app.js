import { createApp } from 'vue';
import HomePage from './components/HomePage.vue';

import CommentForm from './components/CommentForm.vue';


const app = createApp({});
app.component('home-page', HomePage);
app.component('comment-form', CommentForm );
app.mount('#app');

