<template>
  <div>
    <div class="card" v-if="state.course">
      <h2 class="card-header">Course details</h2>

      <div class="card-body">
        <table class="table">
          <tbody>
            <tr>
              <td>Title</td>
              <td>
                {{ state.course.title }}
              </td>
            </tr>
            <tr>
              <td>Category</td>
              <td>
                {{ state.course.course_category.name }}
              </td>
            </tr>
            <tr>
              <td>Description</td>
              <td>
                <span v-html="state.course.description"></span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="card" v-if="state.course">
      <h2 class="card-header">Course Units</h2>

      <div class="card-body">
        <h3>Core units</h3>
        <table class="table">
          <tbody>
            <tr v-for="(unit, index) in coreUnits" :key="index">
              <td>{{ unit.title }}</td>
              <td>
                <router-link
                  :to="getUnitViewLink(unit)"
                  class="btn-link text-primary"
                  v-if="state.completed_units.length + 1 > index"
                  >View</router-link
                >
              </td>
            </tr>
          </tbody>
        </table>

        <h3>Elective units</h3>
        <table class="table">
          <tbody>
            <tr v-for="(unit, index) in electiveUnits" :key="index">
              <td>{{ unit.title }}</td>
              <td>
                <router-link
                  :to="getUnitViewLink(unit)"
                  class="btn-link text-primary"
                  v-if="
                    state.completed_units.length - coreUnits.length + 1 > index
                  "
                  >View</router-link
                >
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
import { computed, reactive, onMounted } from "vue";
import { useRoute } from "vue-router";
import useCourse from "../../../../src/composable/useCourse";

export default {
  setup() {
    const route = useRoute();
    const { getWithUnits, getCompletedUnits } = useCourse();

    const state = reactive({
      course_id: route.params.id,
      course: null,
      completed_units: [],
    });

    onMounted(() => {
      getCourse();
      getUnitsStatus();
    });

    const coreUnits = computed(() => {
      return state.course.units.filter((unit) => unit.type == "core");
    });

    const electiveUnits = computed(() => {
      return state.course.units.filter((unit) => unit.type == "elective");
    });

    const getCourse = () => {
      getWithUnits(state.course_id, "student")
        .then((res) => {
          state.course = res.data;
        })
        .catch((res) => {
          alert(res.response.data.message);
        });
    };

    const getUnitsStatus = () => {
      getCompletedUnits(state.course_id)
        .then((res) => {
          state.completed_units = res.data.data;
        })
        .catch((err) => {
          alert(err.response.data.message);
        });
    };

    const getUnitViewLink = (unit) => {
      return {
        name: "UnitTopicsView",
        params: {
          course_id: state.course_id,
          unit_id: unit.id,
        },
      };
    };

    return {
      state,
      coreUnits,
      electiveUnits,
      getUnitViewLink,
    };
  },
};
</script>
