import { defineStore } from 'pinia';

const useModalsStore = defineStore('useModalsStore', {
  state: () => ({
    open: false,
    type: '',
  }),
  actions: {
    openModal(type: String) {
      this.open = true;
      this.type = type;
    },
    closeModal() {
      this.open = false;
      this.type = '';
    },
    setModalType(type: String) {
      this.type = type;
    },
  },
});

export default useModalsStore;
