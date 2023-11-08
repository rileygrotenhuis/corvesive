import { defineStore } from 'pinia';
import alerts from '~/libs/locales/alerts.js';

const useAlertsStore = defineStore('useAlertsStore', {
  state: () => ({
    alerts: []
  }),
  actions: {
    addAlert(error) {
      const newAlertIndex = this.alerts.push(alerts[error]) - 1;

      setTimeout(() => {
        this.removeAlert(newAlertIndex);
      }, 3000);
    },
    removeAlert(index) {
      this.alerts.splice(index, 1);
    }
  }
});

export default useAlertsStore;
