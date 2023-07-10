import './bootstrap';
import { createApp } from 'vue';
import Calendar from './components/Calendar.vue';

const app = createApp({
    components: {
        Calendar
    }
});

app.mount("#app");