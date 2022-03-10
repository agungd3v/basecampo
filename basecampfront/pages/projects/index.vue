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
            :options="[
              {value: '1', text: 'Agung Ardiyanto'},
              {value: '2', text: 'Bunga Prameswari'}
            ]"
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
            <b-button style="width: 100px" variant="primary" size="sm">Submit</b-button>
          </b-overlay>
        </b-form-group>
      </form>
    </b-modal>
  </b-container>
</template>
<script>
import draggable from 'vuedraggable'
export default {
  components: {
    draggable,
  },
  data() {
    return {
      title: null,
      titleState: null,
      description: null,
      assign: null,
      tags: null,
      images: null,
      submit: false,

      todos: [
        {
          id: 1,
          title: 'Contrary to popular belief, Lorem Ipsum is not simply random text',
          tags: [
            { name: 'Bug', class: 'warning' },
            { name: 'Priority', class: 'danger' },
          ]
        },
        { id: 2, title: 'Todos 2', tags: [] },
        { id: 3, title: 'Todos 3', tags: [] },
        { id: 4, title: 'Todos 4', tags: [] },
        { id: 5, title: 'Todos 5', tags: [] },
        { id: 6, title: 'Todos 6', tags: [] },
        { id: 7, title: 'Todos 7', tags: [] },
        { id: 8, title: 'Todos 8', tags: [] },
        { id: 9, title: 'Todos 9', tags: [] },
        { id: 10, title: 'Todos 10', tags: [] },
      ],
      iceboxs: [],
      backlogs: [],
      progress: [],
      riviews: [],
      completed: [],
    }
  },
  watch: {},
  methods: {
    checkFormValidity() {
      const valid = this.$refs.form.checkValidity()
      this.titleState = valid
      return valid
    },
    resetModal() {
      this.name = null
      this.titleState = null,
      this.description = null
      this.assign = null
    },
    handleOk(evt) {
      evt.preventDefault()
      this.handleSubmit()
    },
    handleSubmit() {
      if (!this.checkFormValidity()) return
      this.$bvToast.toast(`New task ${this.name} has been created`, {
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