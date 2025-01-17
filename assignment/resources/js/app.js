import { createApp } from 'vue';
import TodoList from './components/TodoList.vue'; // Create TodoList component

const app = createApp({});

app.component('todo-list', TodoList);

app.mount('#app');