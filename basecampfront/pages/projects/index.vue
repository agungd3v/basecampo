<template>
  <b-container fluid>
    <b-row>
      <b-col md="12">
        <div class="w-100 text-center" style="height: 8vh">
          <h3 class="mt-4 mb-0">Basecamp</h3>
        </div>
      </b-col>
    </b-row>
    <b-row>
      <b-col md="12">
        <div style="height: 75vh">
          <div class="w-100 h-100">
            <div class="d-flex h-100 overflow-auto" style="gap: 10px">
              <div class="card-item">
                <div class="position-relative ttl-wrap">
                  <div class="ttl-tasks">
                    <span class="pr-2 bg-main">Todos</span>
                    <span class="pl-2 bg-main">{{ todos ? todos.length : 0 }}</span>
                  </div>
                  <div class="divider"></div>
                </div>
                <div class="mb-3 mt-2">
                  <button class="main-btn" v-b-modal.create-task>Create Task</button>
                </div>
                <draggable
                  :list="todos"
                  group="tasks"
                  class="dragdrop"
                >
                  <div
                    v-for="item in todos"
                    :key="item.id"
                    class="mt-1 mb-2"
                  >
                    <b-card :title="item.title" class="cursor-pointer">
                      <div
                        v-if="item.assign.length > 0"
                      >
                        <div class="d-flex align-items-center" style="gap: 3px">
                          <b-avatar
                            v-for="(a, ib) in item.assign"
                            :key="ib"
                            :text="getFirstChar(a.name)"
                            v-b-tooltip.hover
                            :title="a.name"
                            variant="primary"
                            size="1.5rem"
                          ></b-avatar>
                        </div>
                      </div>
                      <div
                        v-if="item.tags"
                        class="d-flex align-items-center"
                        style="gap: 3px"
                      >
                        <b-badge
                          v-for="(tag, idx) in item.tags"
                          :key="idx"
                          :variant="tag.class"
                        >
                          {{ tag.name }}
                        </b-badge>
                      </div>
                    </b-card>
                  </div>
                  <div class="mt-5 mb-2">
                    <b-card class="cursor-pointer">
                      <div class="d-flex align-items-center" style="gap: 3px">
                        <b-badge></b-badge>
                      </div>
                    </b-card>
                  </div>
                </draggable>
              </div>
              <div class="card-item">
                <div class="position-relative ttl-wrap">
                  <div class="ttl-tasks">
                    <span class="pr-2 bg-main">Icebox</span>
                    <span class="pl-2 bg-main">{{ iceboxs ? iceboxs.length : 0 }}</span>
                  </div>
                  <div class="divider"></div>
                </div>
                <div class="mb-3 mt-2">
                  <button class="main-btn">Create Task</button>
                </div>
                <draggable
                  :list="iceboxs"
                  group="tasks"
                  class="dragdrop"
                >
                  <div
                    v-for="item in iceboxs"
                    :key="item.id"
                    class="mt-1 mb-2"
                  >
                    <b-card :title="item.title" class="cursor-pointer">
                      <div
                        v-if="item.tags"
                        class="d-flex align-items-center"
                        style="gap: 3px"
                      >
                        <b-badge
                          v-for="(tag, idx) in item.tags"
                          :key="idx"
                          :variant="tag.class"
                        >
                          {{ tag.name }}
                        </b-badge>
                      </div>
                    </b-card>
                  </div>
                  <div class="mt-5 mb-2">
                    <b-card class="cursor-pointer">
                      <div class="d-flex align-items-center" style="gap: 3px">
                        <b-badge></b-badge>
                      </div>
                    </b-card>
                  </div>
                </draggable>
              </div>
              <div class="card-item">
                <div class="position-relative ttl-wrap">
                  <div class="ttl-tasks">
                    <span class="pr-2 bg-main">Backlog</span>
                    <span class="pl-2 bg-main">{{ backlogs ? backlogs.length : 0 }}</span>
                  </div>
                  <div class="divider"></div>
                </div>
                <div class="mb-3 mt-2">
                  <button class="main-btn">Create Task</button>
                </div>
                <draggable
                  :list="backlogs"
                  group="tasks"
                  class="dragdrop"
                >
                  <div
                    v-for="item in backlogs"
                    :key="item.id"
                    class="mt-1 mb-2"
                  >
                    <b-card :title="item.title" class="cursor-pointer">
                      <div
                        v-if="item.tags"
                        class="d-flex align-items-center"
                        style="gap: 3px"
                      >
                        <b-badge
                          v-for="(tag, idx) in item.tags"
                          :key="idx"
                          :variant="tag.class"
                        >
                          {{ tag.name }}
                        </b-badge>
                      </div>
                    </b-card>
                  </div>
                  <div class="mt-5 mb-2">
                    <b-card class="cursor-pointer">
                      <div class="d-flex align-items-center" style="gap: 3px">
                        <b-badge></b-badge>
                      </div>
                    </b-card>
                  </div>
                </draggable>
              </div>
              <div class="card-item">
                <div class="position-relative ttl-wrap">
                  <div class="ttl-tasks">
                    <span class="pr-2 bg-main">On Progress</span>
                    <span class="pl-2 bg-main">{{ progress ? progress.length : 0 }}</span>
                  </div>
                  <div class="divider"></div>
                </div>
                <div class="mb-3 mt-2">
                  <button class="main-btn">Create Task</button>
                </div>
                <draggable
                  :list="progress"
                  group="tasks"
                  class="dragdrop"
                >
                  <div
                    v-for="item in progress"
                    :key="item.id"
                    class="mt-1 mb-2"
                  >
                    <b-card :title="item.title" class="cursor-pointer">
                      <div
                        v-if="item.tags"
                        class="d-flex align-items-center"
                        style="gap: 3px"
                      >
                        <b-badge
                          v-for="(tag, idx) in item.tags"
                          :key="idx"
                          :variant="tag.class"
                        >
                          {{ tag.name }}
                        </b-badge>
                      </div>
                    </b-card>
                  </div>
                  <div class="mt-5 mb-2">
                    <b-card class="cursor-pointer">
                      <div class="d-flex align-items-center" style="gap: 3px">
                        <b-badge></b-badge>
                      </div>
                    </b-card>
                  </div>
                </draggable>
              </div>
              <div class="card-item">
                <div class="position-relative ttl-wrap">
                  <div class="ttl-tasks">
                    <span class="pr-2 bg-main">QA Riview</span>
                    <span class="pl-2 bg-main">{{ riviews ? riviews.length : 0 }}</span>
                  </div>
                  <div class="divider"></div>
                </div>
                <div class="mb-3 mt-2">
                  <button class="main-btn">Create Task</button>
                </div>
                <draggable
                  :list="riviews"
                  group="tasks"
                  class="dragdrop"
                >
                  <div
                    v-for="item in riviews"
                    :key="item.id"
                    class="mt-1 mb-2"
                  >
                    <b-card :title="item.title" class="cursor-pointer">
                      <div
                        v-if="item.tags"
                        class="d-flex align-items-center"
                        style="gap: 3px"
                      >
                        <b-badge
                          v-for="(tag, idx) in item.tags"
                          :key="idx"
                          :variant="tag.class"
                        >
                          {{ tag.name }}
                        </b-badge>
                      </div>
                    </b-card>
                  </div>
                  <div class="mt-5 mb-2">
                    <b-card class="cursor-pointer">
                      <div class="d-flex align-items-center" style="gap: 3px">
                        <b-badge></b-badge>
                      </div>
                    </b-card>
                  </div>
                </draggable>
              </div>
              <div class="card-item">
                <div class="position-relative ttl-wrap">
                  <div class="ttl-tasks">
                    <span class="pr-2 bg-main">Completed</span>
                    <span class="pl-2 bg-main">{{ completed ? completed.length : 0 }}</span>
                  </div>
                  <div class="divider"></div>
                </div>
                <draggable
                  :list="completed"
                  group="tasks"
                  class="dragdrop"
                >
                  <div
                    v-for="item in completed"
                    :key="item.id"
                    class="mt-1 mb-2"
                  >
                    <b-card :title="item.title" class="cursor-pointer">
                      <div
                        v-if="item.tags"
                        class="d-flex align-items-center"
                        style="gap: 3px"
                      >
                        <b-badge
                          v-for="(tag, idx) in item.tags"
                          :key="idx"
                          :variant="tag.class"
                        >
                          {{ tag.name }}
                        </b-badge>
                      </div>
                    </b-card>
                  </div>
                  <div class="mt-5 mb-2">
                    <b-card class="cursor-pointer">
                      <div class="d-flex align-items-center" style="gap: 3px">
                        <b-badge></b-badge>
                      </div>
                    </b-card>
                  </div>
                </draggable>
              </div>
            </div>
          </div>
        </div>
      </b-col>
    </b-row>
    <b-modal
      id="create-task"
      ref="create-task"
      title="Create Task"
      @show="resetModal"
      @hidden="resetModal"
      hide-footer
    >
      <form ref="form" @submit.stop.prevent="handleSubmit">
        <b-form-group>
          <v-select
            multiple
            placeholder="Assign To"
            :options="assign_list"
            label="text"
            v-model="assign"
          ></v-select>
        </b-form-group>
        <b-form-group
          invalid-feedback="Title is required"
          :state="titleState"
        >
          <b-form-input
            placeholder="Task title"
            size="sm"
            v-model="title"
            :state="titleState"
            autocomplete="off"
            required
          ></b-form-input>
        </b-form-group>
        <b-form-group>
          <b-form-textarea
            v-model="description"
            size="sm"
            rows="5"
            no-resize
            placeholder="Task description"
          ></b-form-textarea>
        </b-form-group>
        <b-form-group
          label="Due Date"
        >
          <b-row>
            <b-col md="6">
              <b-form-datepicker v-model="from_date" size="sm"></b-form-datepicker>
            </b-col>
            <b-col md="6">
              <b-form-datepicker v-model="to_date" size="sm"></b-form-datepicker>
            </b-col>
          </b-row>
        </b-form-group>
        <b-form-group>
          <v-select
            multiple
            placeholder="Tags"
            :options="[
              {value: '1', text: 'Bug'},
              {value: '2', text: 'Priority'}
            ]"
            label="text"
            v-model="tags"
          ></v-select>
        </b-form-group>
        <b-form-group>
          <b-form-file
            multiple
            v-model="images"
            placeholder="Attach image supporter"
            size="sm"
          >
            <template slot="file-name" slot-scope="{ names }">
              <b-badge variant="primary">{{ names[0] }}</b-badge>
              <b-badge v-if="names.length > 1" variant="primary" class="ml-1">
                + {{ names.length - 1 }} More files
              </b-badge>
            </template>
          </b-form-file>
        </b-form-group>
        <b-form-group class="mb-0 mt-4">
          <b-overlay
            :show="submit"
            rounded
            opacity="0.6"
            spinner-small
            spinner-variant="primary"
            class="d-inline-block"
          >
            <b-button style="width: 100px" @click.prevent="handleSubmit" variant="primary" size="sm">Submit</b-button>
          </b-overlay>
        </b-form-group>
      </form>
    </b-modal>
  </b-container>
</template>
<script>
import draggable from 'vuedraggable'
import { mapGetters } from 'vuex'
export default {
  components: {
    draggable,
  },
  middleware: 'auth',
  data() {
    return {
      title: null,
      titleState: null,
      description: null,
      assign: null,
      tags: null,
      images: null,
      submit: false,
      from_date: null,
      to_date: null,

      assign_list: [],

      todos: [],
      iceboxs: [],
      backlogs: [],
      progress: [],
      riviews: [],
      completed: [],
    }
  },
  watch: {},
  computed: {
    ...mapGetters({
      'user': 'user'
    })
  },
  mounted() {
    this.getTask()
    this.getUserInDivision()
  },
  methods: {
    async getTask() {
      try {
        const fetch = await this.$axios.$get('/v1/task')
        if (fetch.status) {
          console.log(fetch.data)
          this.todos = fetch.data.filter(data => data.status == 1)
        }
      } catch (error) {
        throw error
      }
    },
    async getUserInDivision() {
      try {
        const fetch = await this.$axios.$post('/v1/task/user', {
          division_id: this.user.division_id
        })
        if (fetch.status) {
          this.assign_list = fetch.data.map(data => {
            return {
              text: data.name,
              value: data.id
            }
          })
        }
      } catch (error) {
        throw error
      }
    },
    checkFormValidity() {
      const valid = this.$refs.form.checkValidity()
      this.titleState = valid
      return valid
    },
    resetModal() {
      this.title = null
      this.titleState = null,
      this.description = null
      this.assign = null
    },
    handleOk(evt) {
      evt.preventDefault()
      this.handleSubmit()
    },
    async handleSubmit() {
      if (!this.checkFormValidity()) return
      try {
        const store = await this.$axios.$post('/v1/task', {
          title: this.title,
          from_date: this.from_date,
          to_date: this.to_date,
          assign: this.assign ? this.assign.map(data => data.value) : null
        })
        if (store.status) {
          this.$bvToast.toast(`New task has been created`, {
            title: `Info!`,
            toaster: 'b-toaster-bottom-right',
            solid: true,
            variant: 'primary',
            appendToast: true
          })
          this.$nextTick(() => {
            this.$bvModal.hide('create-task')
          })
        }
      } catch (error) {
        throw error
      }
    },
    getFirstChar(text) {
      return text.split('')[0].toUpperCase()
    }
  }
}
</script>
<style>
  .card-title {
    font-size: 14px;
  }
  .card-item {
    min-width: 300px;
    max-width: 360px;
    height: 100%;
    padding: 5px;
    background: transparent;
    overflow: hidden;
    position: relative;
  }
</style>