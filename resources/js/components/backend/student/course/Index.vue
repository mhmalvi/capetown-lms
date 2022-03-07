<template>
  <div>
    <div class="card">
      <h2 class="card-header">Courses</h2>

      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>#</th>
                <th width="100">Thumbnail</th>
                <th>Title</th>
                <th>Category</th>
              </tr>
            </thead>

            <tbody v-if="state.loading">
              <tr>
                <td colspan="12" class="text-center">Loading</td>
              </tr>
            </tbody>

            <tbody v-else-if="state.courses.length == 0">
              <tr>
                <td colspan="12" class="text-center">No courses available</td>
              </tr>
            </tbody>

            <tbody v-else>
              <tr v-for="(course, index) in state.courses" :key="index">
                <td>#</td>
                <td v-html="course.thumbnail_view"></td>
                <td>
                  <div>
                    {{ course.title }}
                  </div>
                  <div>
                    <router-link
                      :to="getCourseViewLink(course)"
                      class="btn-link text-primary"
                      >View</router-link
                    >
                  </div>
                </td>
                <td>{{ course.course_category_name }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { reactive, onMounted } from "vue";
import useCourse from "../../../../src/composable/useCourse";

export default {
  setup() {
    const state = reactive({
      courses: [],
      loading: false,
    });
    const { all: allCourses } = useCourse();

    onMounted(() => {
      getCourses();
    });

    const getCourses = () => {
      state.loading = true;

      allCourses()
        .then((res) => {
          state.courses = res.data.data;
        })
        .catch((res) => {
          alert(res.response.data.message);
        })
        .finally(() => {
          state.loading = false;
        });
    };

    const getCourseViewLink = (course) => {
      return {
        name: "CourseView",
        params: {
          id: course.id,
        },
      };
    };

    return {
      state,
      getCourseViewLink,
    };
  },
};
</script>
