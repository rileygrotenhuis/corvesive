import { defineStore } from 'pinia';

const useModalsStore = defineStore('useModalsStore', {
  state: () => ({
    open: false,
    type: undefined
  }),
  actions: {
    openModal(type) {
      this.open = true;
      this.type = type;
    },
    closeModal() {
      this.open = false;
      this.type = undefined;
    },
    setModalType(type) {
      this.type = type;
    }
  }
});

export default useModalsStore;
