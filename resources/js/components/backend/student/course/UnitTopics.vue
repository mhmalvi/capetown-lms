<template>
  <div>
    <div class="card" v-if="state.loading">
      <div class="card-body">
        <div class="text-center py-5">
          <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
          </div>
        </div>
      </div>
    </div>

    <div v-else>
      <h2>{{ state.unit.title }} - Topics</h2>

      <div class="row" v-for="(topic, index) in state.unit.topics" :key="index">
        <div
          class="card col-md-12"
          v-if="index < state.completed_topics.length + 1"
        >
          <h2 class="card-header">{{ getTopicName(topic.order) }}</h2>

          <div class="card-body">
            <p v-html="topic.description"></p>

            <textarea
              class="form-control"
              v-model="state.form.descriptions[index]"
              v-if="topic.can_user_submit"
            ></textarea>

            <input
              type="file"
              class="form-control"
              v-if="topic.can_user_submit"
              @change.prevent="handleFileChange($event, index)"
            />
            <div>
              <a
                :href="getFileUrl(attachment)"
                v-for="(attachment, index) in topic.attachments"
                :key="index"
                :download="attachment.file_name"
              >
                {{ attachment.file_name }}
              </a>
            </div>

            <div class="d-flex justify-content-start mt-2">
              <button
                class="btn btn-primary"
                @click.prevent="saveSubmission(topic.id, index)"
              >
                Save
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { reactive, onMounted } from "vue";
import { useRoute } from "vue-router";

export default {
  setup() {
    const route = useRoute();
    const state = reactive({
      form: {
        descriptions: {},
        topic_files: {
          0: [],
          1: [],
          2: [],
          3: [],
          4: [],
        },
      },
      unit: {},
      unit_id: route.params.unit_id,
      topics: [],
      loading: false,
      completed_topics: [],
    });

    onMounted(() => {
      getUnitWithTopics();
      getCompletedTopics(state.unit_id);
    });

    const getUnitWithTopics = () => {
      state.loading = true;

      axios
        .get("student/unit/" + state.unit_id)
        .then((res) => {
          state.unit = res.data;
          state.topics = res.data.topics;
        })
        .catch((err) => {
          alert(err.response.data.message);
        })
        .finally(() => {
          state.loading = false;
        });
    };

    const getCompletedTopics = (unit_id) => {
      axios
        .get("student/unit/" + unit_id + "/topics/completed")
        .then((res) => {
          state.completed_topics = res.data;
          state.completed_topics.forEach((topic, index) => {
            state.form.descriptions[index] = topic.assessment;
          });
        })
        .catch((err) => {
          alert(err.response.data.message);
        });
    };

    const getTopicName = (order) => {
      if (order == 1) {
        return "Unit Assessment summary";
      } else if (order == 2) {
        return "Resource";
      } else if (order == 3) {
        return "Powerpoint Presentation";
      } else if (order == 4) {
        return "Workbook";
      } else if (order == 5) {
        return "Assessment";
      }
    };

    const saveSubmission = (topic_id, topic_index) => {
      console.log(state.form, topic_index);
      const description = state.form.descriptions[topic_index];
      const attachments = state.form.topic_files[topic_index];

      axios
        .post(
          "student/unit/" + state.unit_id + "/topics/" + topic_id + "/submit",
          {
            description,
            attachments,
          }
        )
        .then((res) => {
          alert(res.data.message);
          location.reload();
        })
        .catch((err) => {
          alert(err.response.data.message);
        });
    };

    const handleFileChange = (e, topic_no) => {
      let files = e.target.files || e.dataTransfer.files;
      if (!files.length) return;
      let file = files[0];
      let file_name = file.name;

      let reader = new FileReader();
      reader.onload = (e) => {
        state.form.topic_files[topic_no].push({
          name: file_name,
          file: e.target.result,
        });
      };
      reader.readAsDataURL(file);
    };

    const getFileUrl = (attachment) => {
      const url =
        location.origin + "/" + attachment.file_path + attachment.file_name;
      console.log(url);
      return url;
    };

    return {
      state,
      getTopicName,
      saveSubmission,
      handleFileChange,
      getFileUrl,
    };
  },
};
</script>
