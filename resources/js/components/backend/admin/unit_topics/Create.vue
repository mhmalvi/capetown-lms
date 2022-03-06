<template>
  <div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>Create Unit Topic</h5>
            </div>

            <div class="card-body">
              <form class="form" @submit.prevent="processData">
                <div class="form-group">
                  <label for="title" class="form-label">Title</label>
                  <input
                    type="text"
                    class="form-control"
                    name="title"
                    v-model="state.inputData.title"
                    placeholder="Course unit title"
                  />
                </div>

                <div class="form-group">
                  <label for="title" class="form-label">Course</label>
                  <select
                    class="form-control"
                    name="course_id"
                    v-model="state.inputData.course_id"
                  >
                    <option
                      v-for="(course, index) in courses"
                      :key="index"
                      :value="course.id"
                    >
                      {{ course.title }}
                    </option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="thumbnail" class="form-label">Thumbnail</label>
                  <input type="file" name="thumbnail" class="form-control" />
                </div>

                <FormButton
                  :isEdit="state.isEdit"
                  :backUrl="state.backUrl"
                ></FormButton>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { onMounted, reactive, ref } from "vue";
import useCreate from "../../../../src/composable/use-create";

export default {
  setup() {
    let { processData, editForm, state } = useCreate();

    state.generalApi = "course-units";
    state.backUrl = "/course-units";
    state.isFile = true;

    let courses = ref([]);

    onMounted(() => {
      getCourses();
    });

    let getCourses = () => {
      axios.get(state.base_url + "/api/course").then((response) => {
        courses.value = response.data.data;
      });
    };

    return {
      processData,
      editForm,
      state,
      courses,
    };
  },
};
</script>

