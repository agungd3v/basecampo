import Vue from 'vue'
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css';

Vue.component('v-select', {
  extends: vSelect,
  methods:{
    toggleDropdown(event) {
      const targetIsNotSearch = event.target !== this.searchEl;
      if (targetIsNotSearch) {
        event.preventDefault();
      }
      if (event.target.closest('.vs__deselect, .vs__clear')) {
        event.preventDefault();
        return;
      }
      if (this.open && targetIsNotSearch) {
        this.searchEl.blur();
      } else if (!this.disabled) {
        this.open = true;
        this.searchEl.focus();
      }
    }
  }
})