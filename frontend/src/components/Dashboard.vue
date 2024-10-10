<template>
  <div>
    <h1>Fixtures</h1>
    <button @click="generateFixtures">Generate Fixtures</button>
    <div>
      <label for="week">Select Week:</label>
      <input type="number" v-model="selectedWeek" min="1" />
      <button @click="fetchWeekFixtures">Get Week Fixtures</button>
    </div>
    <table>
      <thead>
      <tr>
        <th>ID</th>
        <th>Home Team</th>
        <th>Away Team</th>
        <th>Week</th>
        <th>Status</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="fixture in fixtures" :key="fixture.id">
        <td>{{ fixture.id }}</td>
        <td>{{ fixture.home_team.name }}</td>
        <td>{{ fixture.away_team.name }}</td>
        <td>{{ fixture.week }}</td>
        <td>{{ fixture.status }}</td>
      </tr>
      </tbody>
    </table>
    <button @click="playWeek">Play Selected Week</button>
    <button @click="playAllWeeks">Play All Weeks</button>
  </div>
</template>

<script>
import { ref } from 'vue';
import { leagueService } from '@/services/leagueService';

export default {
  setup() {
    const fixtures = ref([]);
    const selectedWeek = ref(1);

    const generateFixtures = async () => {
      await leagueService.generateFixtures();
      await fetchAllFixtures();
    };

    const fetchAllFixtures = async () => {
      const response = await leagueService.getAllFixtures();
      fixtures.value = response.data;
    };

    const fetchWeekFixtures = async () => {
      const response = await leagueService.getWeekFixtures(selectedWeek.value);
      fixtures.value = response.data;
    };

    const playWeek = async () => {
      await leagueService.playWeek(selectedWeek.value);
      await fetchAllFixtures();
    };

    const playAllWeeks = async () => {
      await leagueService.playAllWeeks();
      await fetchAllFixtures();
    };

    return {
      fixtures,
      selectedWeek,
      generateFixtures,
      fetchAllFixtures,
      fetchWeekFixtures,
      playWeek,
      playAllWeeks,
    };
  },
};
</script>
