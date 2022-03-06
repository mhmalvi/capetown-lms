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

    return {
      state,
      handleFormSubmit,
      goBack,
    };
  },
};
</script>
