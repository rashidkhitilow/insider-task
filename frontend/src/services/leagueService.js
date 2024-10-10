import api from '@/services/api';

export const leagueService = {
    generateFixtures() {
        return api.post(`/generate-fixtures`);
    },
    getAllFixtures() {
        return api.get(`/fixtures`);
    },
    getWeekFixtures(week) {
        return api.get(`/fixture/${week}`);
    },
    playWeek(week) {
        return api.post(`/play/week/${week}`);
    },
    playAllWeeks() {
        return api.post(`/play/all`);
    },
    resetData() {
        return api.post(`/reset`);
    },
    getStandings() {
        return api.get(`/standings-table`);
    },
    getPredictions() {
        return api.get(`/predictions`);
    },
};
