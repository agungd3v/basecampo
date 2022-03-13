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
                  @change="moveTodo"
                >
                  <div
                    v-for="item in todos"
                    :key="item.id"
                    class="mt-1 mb-2 position-relative"
                  >
                    <div class="info-task-tag">
                      <div
                        v-if="item.tags"
                        class="d-flex align-items-center"
                        style="gap: 3px"
                      >
                        <b-badge
                          v-for="(tag, idx) in item.tags"
                          :key="idx"
                          :variant="tag.variant"
                          class="px-2"
                        >
                          {{ tag.name }}
                        </b-badge>
                      </div>
                    </div>
                    <b-card
                      :title="item.title"
                      class="cursor-pointer"
                      :class="item.tags.length > 0 ? 'pt-3' : ''"
                    >
                      <div
                        v-if="item.to_date"
                        class="mt-2"
                      >
                        <div class="info-task-date">
                          <div class="info-task-day">{{ getTaskDate(item.to_date, 'day') }}</div>
                          <p class="my-1 mb-0">{{ getTaskDate(item.to_date, 'date') }}</p>
                        </div>
                      </div>
                      <div
                        v-if="item.assign.length > 0"
                        class="mt-1"
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
                  @change="moveIcebox"
                >
                  <div
                    v-for="item in iceboxs"
                    :key="item.id"
                    class="mt-1 mb-2 position-relative"
                  >
                    <div class="info-task-tag">
                      <div
                        v-if="item.tags"
                        class="d-flex align-items-center"
                        style="gap: 3px"
                      >
                        <b-badge
                          v-for="(tag, idx) in item.tags"
                          :key="idx"
                          :variant="tag.variant"
                          class="px-2"
                        >
                          {{ tag.name }}
                        </b-badge>
                      </div>
                    </div>
                    <b-card
                      :title="item.title"
                      class="cursor-pointer"
                      :class="item.tags.length > 0 ? 'pt-3' : ''"
                    >
                      <div
                        v-if="item.to_date"
                        class="mt-2"
                      >
                        <div class="info-task-date">
                          <div class="info-task-day">{{ getTaskDate(item.to_date, 'day') }}</div>
                          <p class="my-1 mb-0">{{ getTaskDate(item.to_date, 'date') }}</p>
                        </div>
                      </div>
                      <div
                        v-if="item.assign.length > 0"
                        class="mt-1"
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
                  @change="moveBacklog"
                >
                  <div
                    v-for="item in backlogs"
                    :key="item.id"
                    class="mt-1 mb-2 position-relative"
                  >
                    <div class="info-task-tag">
                      <div
                        v-if="item.tags"
                        class="d-flex align-items-center"
                        style="gap: 3px"
                      >
                        <b-badge
                          v-for="(tag, idx) in item.tags"
                          :key="idx"
                          :variant="tag.variant"
                          class="px-2"
                        >
                          {{ tag.name }}
                        </b-badge>
                      </div>
                    </div>
                    <b-card
                      :title="item.title"
                      class="cursor-pointer"
                      :class="item.tags.length > 0 ? 'pt-3' : ''"
                    >
                      <div
                        v-if="item.to_date"
                        class="mt-2"
                      >
                        <div class="info-task-date">
                          <div class="info-task-day">{{ getTaskDate(item.to_date, 'day') }}</div>
                          <p class="my-1 mb-0">{{ getTaskDate(item.to_date, 'date') }}</p>
                        </div>
                      </div>
                      <div
                        v-if="item.assign.length > 0"
                        class="mt-1"
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
                  @change="moveProgress"
                >
                  <div
                    v-for="item in progress"
                    :key="item.id"
                    class="mt-1 mb-2 position-relative"
                  >
                    <div class="info-task-tag">
                      <div
                        v-if="item.tags"
                        class="d-flex align-items-center"
                        style="gap: 3px"
                      >
                        <b-badge
                          v-for="(tag, idx) in item.tags"
                          :key="idx"
                          :variant="tag.variant"
                          class="px-2"
                        >
                          {{ tag.name }}
                        </b-badge>
                      </div>
                    </div>
                    <b-card
                      :title="item.title"
                      class="cursor-pointer"
                      :class="item.tags.length > 0 ? 'pt-3' : ''"
                    >
                      <div
                        v-if="item.to_date"
                        class="mt-2"
                      >
                        <div class="info-task-date">
                          <div class="info-task-day">{{ getTaskDate(item.to_date, 'day') }}</div>
                          <p class="my-1 mb-0">{{ getTaskDate(item.to_date, 'date') }}</p>
                        </div>
                      </div>
                      <div
                        v-if="item.assign.length > 0"
                        class="mt-1"
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
                  @change="moveRiview"
                >
                  <div
                    v-for="item in riviews"
                    :key="item.id"
                    class="mt-1 mb-2 position-relative"
                  >
                    <div class="info-task-tag">
                      <div
                        v-if="item.tags"
                        class="d-flex align-items-center"
                        style="gap: 3px"
                      >
                        <b-badge
                          v-for="(tag, idx) in item.tags"
                          :key="idx"
                          :variant="tag.variant"
                          class="px-2"
                        >
                          {{ tag.name }}
                        </b-badge>
                      </div>
                    </div>
                    <b-card
                      :title="item.title"
                      class="cursor-pointer"
                      :class="item.tags.length > 0 ? 'pt-3' : ''"
                    >
                      <div
                        v-if="item.to_date"
                        class="mt-2"
                      >
                        <div class="info-task-date">
                          <div class="info-task-day">{{ getTaskDate(item.to_date, 'day') }}</div>
                          <p class="my-1 mb-0">{{ getTaskDate(item.to_date, 'date') }}</p>
                        </div>
                      </div>
                      <div
                        v-if="item.assign.length > 0"
                        class="mt-1"
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
                  @change="moveComplete"
                >
                  <div
                    v-for="item in completed"
                    :key="item.id"
                    class="mt-1 mb-2"
                  >
                    <b-card
                      :title="item.title"
                      class="cursor-pointer position-relative pl-3"
                    >
                      <div class="mark-complete">
                        <b-icon
                          icon="check-square-fill"
                          variant="success"
                          font-scale="1.1"
                        ></b-icon>
                      </div>
                      <div
                        v-if="item.to_date"
                        class="mt-2"
                      >
                        <div class="info-task-date">
                          <div class="info-task-day">{{ getTaskDate(item.to_date, 'day') }}</div>
                          <p class="my-1 mb-0">{{ getTaskDate(item.to_date, 'date') }}</p>
                        </div>
                      </div>
                      <div
                        v-if="item.assign.length > 0"
                        class="mt-1"
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
            :options="tag_list"
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
      tag_list: [],

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
    this.getTags()
  },
  methods: {
    async getTask() {
      try {
        const fetch = await this.$axios.$get('/v1/task')
        if (fetch.status) {
          this.todos = fetch.data.filter(data => data.status == 1)
          this.iceboxs = fetch.data.filter(data => data.status == 2)
          this.backlogs = fetch.data.filter(data => data.status == 3)
          this.progress = fetch.data.filter(data => data.status == 4)
          this.riviews = fetch.data.filter(data => data.status == 5)
          this.completed = fetch.data.filter(data => data.status == 6)
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
    async getTags() {
      try {
        const fetch = await this.$axios.$get('/v1/task/tags')
        if (fetch.status) {
          this.tag_list = fetch.data.map(data => {
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
          assign: this.assign ? this.assign.map(data => data.value) : null,
          tags: this.tags ? this.tags.map(data => data.value) : null
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
    },
    getTaskDate(text, type) {
      const day = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']
      if (type == 'date') return text.split('-')[2].toString()
      if (type == 'day') {
        const date = new Date(text).getDay()
        return day[date]
      }
    },
    async moveTodo(data) {
      if (data.added) {
        try {
          const store = await this.$axios.$post('/v1/task/change', {
            task_id: data.added.element.id,
            status: 1,
          })
          if (store.status) {
            this.$bvToast.toast(`Task changes to todo`, {
              title: `Info!`,
              toaster: 'b-toaster-bottom-right',
              solid: true,
              variant: 'primary',
              appendToast: true
            })
          }
        } catch (error) {
          throw error
        }
      }
    },
    async moveIcebox(data) {
      if (data.added) {
        try {
          const store = await this.$axios.$post('/v1/task/change', {
            task_id: data.added.element.id,
            status: 2,
          })
          if (store.status) {
            this.$bvToast.toast(`Task changes to icebox`, {
              title: `Info!`,
              toaster: 'b-toaster-bottom-right',
              solid: true,
              variant: 'info',
              appendToast: true
            })
          }
        } catch (error) {
          throw error
        }
      }
    },
    async moveBacklog(data) {
      if (data.added) {
        try {
          const store = await this.$axios.$post('/v1/task/change', {
            task_id: data.added.element.id,
            status: 3,
          })
          if (store.status) {
            this.$bvToast.toast(`Task changes to backlog`, {
              title: `Info!`,
              toaster: 'b-toaster-bottom-right',
              solid: true,
              variant: 'warning',
              appendToast: true
            })
          }
        } catch (error) {
          throw error
        }
      }
    },
    async moveProgress(data) {
      if (data.added) {
        try {
          const store = await this.$axios.$post('/v1/task/change', {
            task_id: data.added.element.id,
            status: 4,
          })
          if (store.status) {
            this.$bvToast.toast(`Task changes to progress`, {
              title: `Info!`,
              toaster: 'b-toaster-bottom-right',
              solid: true,
              variant: 'success',
              appendToast: true
            })
          }
        } catch (error) {
          throw error
        }
      }
    },
    async moveRiview(data) {
      if (data.added) {
        try {
          const store = await this.$axios.$post('/v1/task/change', {
            task_id: data.added.element.id,
            status: 5,
          })
          if (store.status) {
            this.$bvToast.toast(`Task changes to riview`, {
              title: `Info!`,
              toaster: 'b-toaster-bottom-right',
              solid: true,
              variant: 'danger',
              appendToast: true
            })
          }
        } catch (error) {
          throw error
        }
      }
    },
    async moveComplete(data) {
      if (data.added) {
        try {
          const store = await this.$axios.$post('/v1/task/change', {
            task_id: data.added.element.id,
            status: 6,
          })
          if (store.status) {
            this.$bvToast.toast(`Task complete`, {
              title: `Info!`,
              toaster: 'b-toaster-bottom-right',
              solid: true,
              variant: 'success',
              appendToast: true
            })
          }
        } catch (error) {
          throw error
        }
      }
    }
  }
}
</script>
<style>
  .card-title {
    font-size: 14px;
    margin-bottom: 3px;
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