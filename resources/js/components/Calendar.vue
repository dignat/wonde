<script setup>
import { ref, computed } from 'vue';

const currentMonth = ref(new Date());
const selectedDate = ref(null);
const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
const datesFromAPI = ref([]);

const fetchDatesFromAPI = () => {
  // Make an API request to retrieve the dates from your Laravel API
  // Assuming you have a route named '/api/dates' that returns the dates as an array
  fetch('/api/dates')
    .then(response => response.json())
    .then(data => {
      datesFromAPI.value = data; // Store the received dates in the component's data
    })
    .catch(error => {
      console.error('Error fetching dates from API:', error);
    });
};

const calendar = computed(() => {
  const year = currentMonth.value.getFullYear();
  const month = currentMonth.value.getMonth();
  const firstDay = new Date(year, month, 1);
  const lastDay = new Date(year, month + 1, 0);
  const startDate = new Date(firstDay);
  startDate.setDate(startDate.getDate() - startDate.getDay());
  const endDate = new Date(lastDay);
  endDate.setDate(endDate.getDate() + (6 - endDate.getDay()));

  const calendar = [];
  let week = [];
  let currentDate = new Date(startDate);

  while (currentDate <= endDate) {
    week.push(new Date(currentDate));
    if (currentDate.getDay() === 6) {
      calendar.push(week);
      week = [];
    }
    currentDate.setDate(currentDate.getDate() + 1);
  }

  return calendar;
});

const isToday = date => {
  const today = new Date();
  return (
    date.getDate() === today.getDate() &&
    date.getMonth() === today.getMonth() &&
    date.getFullYear() === today.getFullYear()
  );
};

const isSelected = date => {
  return (
    selectedDate.value &&
    date.getDate() === selectedDate.value.getDate() &&
    date.getMonth() === selectedDate.value.getMonth() &&
    date.getFullYear() === selectedDate.value.getFullYear()
  );
};

const selectDate = date => {
  selectedDate.value = new Date(date);
};

fetchDatesFromAPI();
</script>
<template>
    <div class="calendar">
    <div class="header">
      <button @click="previousMonth">&lt;</button>
      <h2>{{ currentMonth }}</h2>
      <button @click="nextMonth">&gt;</button>
    </div>
    <table>
      <thead>
        <tr>
          <th v-for="day in daysOfWeek" :key="day">{{ day }}</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="week in calendar" :key="week">
          <td v-for="date in week" :key="date" :class="{ today: isToday(date), selected: isSelected(date) }" @click="selectDate(date)">
            {{ date.getDate() }}
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<style scoped>
.calendar {
  font-family: Arial, sans-serif;
  width: 300px;
}

.header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 10px;
}

table {
  width: 100%;
}

th {
  padding: 5px;
  text-align: center;
  font-weight: bold;
}

td {
  padding: 5px;
  text-align: center;
  cursor: pointer;
}

td.today {
  background-color: #efefef;
}

td.selected {
  background-color: blue;
  color: #fff;
}
</style>







