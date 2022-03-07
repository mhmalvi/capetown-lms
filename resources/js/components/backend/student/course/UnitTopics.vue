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

    <div class="card" v-else>
      <h2 class="card-header">{{ state.unit.title }} - Topics</h2>

      <div class="card-body">
        <table class="table">
          <tbody>
            <tr v-for="(topic, index) in state.unit.topics" :key="index">
              <td>{{ getTopicName(topic.order) }}</td>
              <td>
                <input type="file" class="form-control" />
              </td>
            </tr>
          </tbody>
        </table>
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
      unit: {},
      unit_id: route.params.unit_id,
      topics: [],
      loading: false,
    });

    onMounted(() => {
      getUnitWithTopics();
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

    return {
      state,
      getTopicName,
    };
  },
};
</script>
