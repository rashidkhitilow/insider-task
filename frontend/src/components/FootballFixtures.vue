<template>
  <div class="container">
    <h1 class="title">League Fixtures & Standings</h1>

    <div class="top-controls">
      <button v-if="!generated" class="btn primary" @click="generateFixtures">Generate Fixtures</button>
      <button class="btn reset" @click="resetLeague">Reset League</button>
    </div>

    <!-- Week Selection -->
    <div class="week-selection" v-if="generated">
      <label for="week">Select Week:</label>
      <input type="number" v-model="selectedWeek" class="week-input" min="1" />
      <button class="btn secondary" @click="fetchWeekFixtures">Get Week Fixtures</button>
    </div>

    <!-- Fixtures Table -->
    <h2>Fixtures</h2>
    <table v-if="fixtures.length > 0" class="table fixtures-table">
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
    <h5 v-else>Not fixture yet</h5>
    <!-- Standings Table -->
    <h2>League Standings</h2>
    <table v-if="standings.length > 0" class="table standings-table">
      <thead>
      <tr>
        <th>Team</th>
        <th>Played</th>
        <th>Won</th>
        <th>Lost</th>
        <th>Draw</th>
        <th>Points</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="team in standings" :key="team.id">
        <td>{{ team.team.short_name }}</td>
        <td>{{ team.played }}</td>
        <td>{{ team.wins }}</td>
        <td>{{ team.losses }}</td>
        <td>{{ team.draws }}</td>
        <td>{{ team.points }}</td>
      </tr>
      </tbody>
    </table>

    <!-- Predictions Table -->
    <h2>Predictions</h2>
    <table v-if="predictions.length > 0" class="table predictions-table">
      <thead>
      <tr>
        <th>Team</th>
        <th>Percentage</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="prediction in predictions" :key="prediction.team_id">
        <td>{{ prediction.team }}</td>
        <td>{{ prediction.percentage }}%</td>
      </tr>
      </tbody>
    </table>

    <!-- Match Control Buttons -->
    <div class="bottom-controls" v-if="generated">
      <button class="btn primary" @click="playWeek">Play Selected Week</button>
      <button class="btn secondary" @click="playAllWeeks">Play All Weeks</button>
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import { leagueService } from '@/services/leagueService';

export default {
  setup() {
    const fixtures = ref([]);
    const standings = ref([]);
    const predictions = ref([]);
    const selectedWeek = ref(1);
    const generated = ref(false);

    const generateFixtures = async () => {
      await leagueService.generateFixtures();
      await fetchAllFixtures();
      await fetchStandings();
      await fetchPredictions();
      generated.value = true;
    };

    const fetchAllFixtures = async () => {
      const response = await leagueService.getAllFixtures();
      fixtures.value = response.data;
      generated.value = fixtures.value.length > 0;
    };

    const fetchWeekFixtures = async () => {
      const response = await leagueService.getWeekFixtures(selectedWeek.value);
      fixtures.value = response.data;
    };

    const fetchStandings = async () => {
      const response = await leagueService.getStandings();
      standings.value = response.data;
    };

    const fetchPredictions = async () => {
      const response = await leagueService.getPredictions();
      predictions.value = response.data;
    };

    const playWeek = async () => {
      await leagueService.playWeek(selectedWeek.value);
      await fetchAllFixtures();
      await fetchStandings();
      await fetchPredictions();
    };

    const playAllWeeks = async () => {
      await leagueService.playAllWeeks();
      await fetchAllFixtures();
      await fetchStandings();
      await fetchPredictions();
    };

    const resetLeague = async () => {
      await leagueService.reset();
      window.location.reload();
    };

    onMounted(async () => {
      await fetchAllFixtures();
      await fetchStandings();
      await fetchPredictions();
    });

    return {
      fixtures,
      standings,
      predictions,
      selectedWeek,
      generated,
      generateFixtures,
      fetchAllFixtures,
      fetchWeekFixtures,
      playWeek,
      playAllWeeks,
      resetLeague,
    };
  },
};
</script>

<style scoped>
.container {
  max-width: 1000px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f9f9f9;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.title {
  text-align: center;
  margin-bottom: 20px;
}

.top-controls,
.bottom-controls {
  display: flex;
  justify-content: space-between;
  margin-bottom: 20px;
}

.week-selection {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
  margin-bottom: 20px;
}

.week-selection label {
  font-weight: bold;
}

.week-input {
  padding: 8px;
  width: 60px;
  text-align: center;
  border-radius: 4px;
  border: 1px solid #ddd;
}

.table {
  width: 100%;
  border-collapse: collapse;
  margin-bottom: 20px;
}

.table th, .table td {
  padding: 10px;
  border: 1px solid #ddd;
  text-align: center;
}

h2 {
  margin-top: 40px;
}

.btn {
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 14px;
}

.btn.primary {
  background-color: #4CAF50;
  color: white;
}

.btn.secondary {
  background-color: #2196F3;
  color: white;
}

.btn.reset {
  background-color: #f44336;
  color: white;
}

.btn:hover {
  opacity: 0.9;
}

.btn:disabled {
  background-color: #ccc;
  cursor: not-allowed;
}
</style>
