<template>
  <div>
    <div class="card">
      <h3 class="card-header">Unit Topics</h3>

      <div class="card-body">
        <form @submit.prevent="handleFormSubmit">
          <div class="table-resposive">
            <table class="table">
              <tbody>
                <tr>
                  <td>Topic 1</td>
                  <td>
                    <textarea
                      type="text"
                      class="form-control"
                      v-model="state.form.topic_1"
                    ></textarea>
                    <label>
                      <input
                        type="checkbox"
                        v-model="state.form.topic_1_user_submission"
                        :checked="state.form.topic_1_user_submission"
                      />
                      Can user submit any file?
                    </label>
                    <div>
                      <input
                        type="file"
                        class="form-control"
                        @change="addFile($event, 1)"
                      />
                    </div>
                    <div>
                      <ul>
                        <li
                          v-for="(attachment, index) in state.files[1]"
                          :key="index"
                        >
                          {{ attachment.file_name }}
                        </li>
                      </ul>
                    </div>
                    <small
                      class="text-danger"
                      v-if="
                        state.validation.errors &&
                        state.validation.errors.topic_1
                      "
                    >
                      {{ state.validation.errors.topic_1[0] }}
                    </small>
                  </td>
                </tr>
                <tr>
                  <td>Topic 2</td>
                  <td>
                    <textarea
                      type="text"
                      class="form-control"
                      v-model="state.form.topic_2"
                    ></textarea>
                    <label>
                      <input
                        type="checkbox"
                        v-model="state.form.topic_2_user_submission"
                        :checked="state.form.topic_2_user_submission"
                      />
                      Can user submit any file?
                    </label>
                    <div>
                      <input
                        type="file"
                        class="form-control"
                        @change="addFile($event, 2)"
                      />
                    </div>
                    <div>
                      <ul>
                        <li
                          v-for="(attachment, index) in state.files[2]"
                          :key="index"
                        >
                          {{ attachment.file_name }}
                        </li>
                      </ul>
                    </div>
                    <small
                      class="text-danger"
                      v-if="
                        state.validation.errors &&
                        state.validation.errors.topic_2
                      "
                    >
                      {{ state.validation.errors.topic_2[0] }}
                    </small>
                  </td>
                </tr>
                <tr>
                  <td>Topic 3</td>
                  <td>
                    <textarea
                      type="text"
                      class="form-control"
                      v-model="state.form.topic_3"
                    ></textarea>
                    <label>
                      <input
                        type="checkbox"
                        v-model="state.form.topic_3_user_submission"
                        :checked="state.form.topic_3_user_submission"
                      />
                      Can user submit any file?
                    </label>
                    <div>
                      <input
                        type="file"
                        class="form-control"
                        @change="addFile($event, 3)"
                      />
                    </div>
                    <div>
                      <ul>
                        <li
                          v-for="(attachment, index) in state.files[3]"
                          :key="index"
                        >
                          {{ attachment.file_name }}
                        </li>
                      </ul>
                    </div>
                    <small
                      class="text-danger"
                      v-if="
                        state.validation.errors &&
                        state.validation.errors.topic_3
                      "
                    >
                      {{ state.validation.errors.topic_3[0] }}
                    </small>
                  </td>
                </tr>
                <tr>
                  <td>Topic 4</td>
                  <td>
                    <textarea
                      type="text"
                      class="form-control"
                      v-model="state.form.topic_4"
                    ></textarea>
                    <label>
                      <input
                        type="checkbox"
                        v-model="state.form.topic_4_user_submission"
                        :checked="state.form.topic_4_user_submission"
                      />
                      Can user submit any file?
                    </label>
                    <div>
                      <input
                        type="file"
                        class="form-control"
                        @change="addFile($event, 4)"
                      />
                    </div>
                    <div>
                      <ul>
                        <li
                          v-for="(attachment, index) in state.files[4]"
                          :key="index"
                        >
                          {{ attachment.file_name }}
                        </li>
                      </ul>
                    </div>
                    <small
                      class="text-danger"
                      v-if="
                        state.validation.errors &&
                        state.validation.errors.topic_4
                      "
                    >
                      {{ state.validation.errors.topic_4[0] }}
                    </small>
                  </td>
                </tr>
                <tr>
                  <td>Topic 5</td>
                  <td>
                    <textarea
                      type="text"
                      class="form-control"
                      v-model="state.form.topic_5"
                    ></textarea>
                    <label>
                      <input
                        type="checkbox"
                        v-model="state.form.topic_5_user_submission"
                        :checked="state.form.topic_5_user_submission"
                      />
                      Can user submit any file?
                    </label>
                    <div>
                      <input
                        type="file"
                        class="form-control"
                        @change="addFile($event, 5)"
                      />
                    </div>
                    <div>
                      <ul>
                        <li
                          v-for="(attachment, index) in state.files[5]"
                          :key="index"
                        >
                          {{ attachment.file_name }}
                        </li>
                      </ul>
                    </div>
                    <small
                      class="text-danger"
                      v-if="
                        state.validation.errors &&
                        state.validation.errors.topic_5
                      "
                    >
                      {{ state.validation.errors.topic_5[0] }}
                    </small>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="d-flex justify-content-end">
            <button class="btn btn-outline-danger mr-2" @click.prevent="goBack">
              Cancel
            </button>
            <button class="btn btn-primary">
              <i
                class="fas fa-circle-notch fa-spin mr-2"
                v-show="state.saving"
              ></i>
              Save
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import { onMounted, reactive } from "@vue/runtime-core";
import { useRoute, useRouter } from "vue-router";

export default {
  setup() {
    const state = reactive({
      form: {
        topic_1: "",
        topic_2: "",
        topic_3: "",
        topic_4: "",
        topic_5: "",
        topic_1_user_submission: "",
        topic_2_user_submission: "",
        topic_3_user_submission: "",
        topic_4_user_submission: "",
        topic_5_user_submission: "",
        topic_files: {
          1: [],
          2: [],
          3: [],
          4: [],
          5: [],
        },
      },
      files: {
        1: [],
        2: [],
        3: [],
        4: [],
        5: [],
      },
      validation: {
        errors: [],
        message: "",
      },
      subject_id: "",
      saving: false,
    });
    const route = useRoute();
    const router = useRouter();

    onMounted(() => {
      state.subject_id = route.params.id;
      getTopics();
    });

    const getTopics = () => {
      axios.get("course-units/" + state.subject_id + "/topics").then((res) => {
        if (res.data.data.length != 0) {
          state.form.topic_1 = res.data.data[0].description;
          state.form.topic_2 = res.data.data[1].description;
          state.form.topic_3 = res.data.data[2].description;
          state.form.topic_4 = res.data.data[3].description;
          state.form.topic_5 = res.data.data[4].description;

          state.form.topic_1_user_submission = res.data.data[0].can_user_submit;
          state.form.topic_2_user_submission = res.data.data[1].can_user_submit;
          state.form.topic_3_user_submission = res.data.data[2].can_user_submit;
          state.form.topic_4_user_submission = res.data.data[3].can_user_submit;
          state.form.topic_5_user_submission = res.data.data[4].can_user_submit;

          state.files[1] = res.data.data[0].attachments;
          state.files[2] = res.data.data[1].attachments;
          state.files[3] = res.data.data[2].attachments;
          state.files[4] = res.data.data[3].attachments;
          state.files[5] = res.data.data[4].attachments;
        }
      });
    };

    const handleFormSubmit = () => {
      resetValidation();
      state.saving = true;

      axios
        .post("course-units/" + state.subject_id + "/topics", state.form)
        .then((res) => {
          alert(res.data.message);
        })
        .catch((err) => {
          state.validation.errors = err.response.data.errors;
          state.validation.message = err.response.data.message;
        })
        .finally(() => {
          state.saving = false;
        });
    };

    const resetValidation = () => {
      state.validation = {
        errors: [],
        message: "",
      };
    };

    const goBack = () => {
      router.back();
    };

    const addFile = (e, topic_no) => {
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

    return {
      state,
      handleFormSubmit,
      goBack,
      addFile,
    };
  },
};
</script>
