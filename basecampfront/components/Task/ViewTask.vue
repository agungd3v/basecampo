<template>
  <b-modal
    ref="view-task"
    hide-footer
    size="lg"
    title="Task Preview"
    @hidden="reset"
  >
    <form>
      <div v-if="viewData">
        <h3>{{ viewData.title }}</h3>
      </div>
    </form>
  </b-modal>
</template>
<script>
export default {
  props: {
    open: {
      type: Boolean,
      default: false
    },
    viewData: {
      type: Object,
      default: null
    }
  },
  watch: {
    open(bool) {
      if (bool) return this.$refs['view-task'].show()
    }
  },
  methods: {
    reset() {
      this.$emit('hide-view', false)
    }
  }
}
</script>