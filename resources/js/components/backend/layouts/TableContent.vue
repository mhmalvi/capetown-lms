<template>
  <div class="col-md-12 col-lg-12 col-sm-12 col-xs-4">
    <div class="card">
      <div class="card-header">
        <span class="card-title">{{ state.cardTitle }}</span>
        <pulseLoader v-if="state.isLoading" class="text-center"></pulseLoader>

        <router-link
          :to="route.path + '/create'"
          class="btn btn-sm btn-primary float-right m-1"
          v-if="state.isAddItem"
          >Add New</router-link
        >
        <button
          type="button"
          v-if="state.isUpload"
          class="btn btn-sm btn-primary float-right m-1 modal_show_button"
          data-toggle="modal"
          data-target="#exampleModal"
        >
          Upload Excel
        </button>
      </div>
      <div class="card-body">
        <table class="table table-bordered table-response">
          <thead>
            <tr class="table-secondary">
              <th class="text-center">SI.</th>
              <th class="text-center" v-for="(td, th) in state.table" :key="th">
                {{ th }}
              </th>
              <th class="text-center" v-if="state.isActionBtn">Action</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in state.dataList.data" :key="index">
              <td style="text-align: center">
                {{ state.dataList.meta.from + index }}
              </td>
              <td
                style="text-align: center"
                v-for="(td, th) in state.table"
                :key="th"
                v-html="item[td]"
              ></td>
              <td class="text-center" v-if="state.isActionBtn">
                <span
                  v-if="state.customActions && state.customActions.length > 0"
                >
                  <a
                    href="#"
                    v-for="(action, index) in state.customActions"
                    :key="index"
                    @click.prevent="action.fn(item)"
                    :class="'btn btn-circle btn-sm m-1 ' + action.classes"
                  >
                    <i :class="action.icon_classes"></i>
                  </a>
                </span>
                <a
                  href="#"
                  v-if="state.isSingle"
                  @click.prevent="isSingleData(item)"
                  class="btn btn-success btn-circle btn-sm m-1"
                >
                  <i class="fa fa-send"></i> {{ state.actionTitle }}
                </a>
                <a
                  href="#"
                  v-if="state.isEditBtn"
                  @click.prevent="showEditForm(item.id)"
                  class="btn btn-success btn-circle btn-sm m-1"
                >
                  <i class="fa fa-edit"></i>
                </a>
                <a
                  href="#"
                  v-if="state.isDelBtn"
                  @click.prevent="deleteItem(item.id)"
                  class="btn btn-danger btn-circle btn-sm m-1"
                >
                  <i class="fa fa-trash"></i>
                </a>
              </td>
            </tr>
            <!-- <tr v-if="state.dataList.data.length == 0"><td :colspan="state.table.length" class="text-danger text-center">No data available!</td></tr> -->
          </tbody>
        </table>
      </div>
      <div class="card-footer clearfix"></div>
    </div>
    <!-- /.card -->
  </div>
</template>

<script>
import { computed, reactive, toRef } from "vue";
import { useRoute } from "vue-router";
export default {
  props: ["stateProperty", "getDataList", "showEditForm", "deleteItem"],
  setup(props, context) {
    let route = useRoute();
    let propsObj = toRef(props.stateProperty);
    let state = propsObj._object;
    let showEditForm = props.showEditForm;
    let deleteItem = props.deleteItem;
    let getDataList = props.getDataList;

    console.log("dataList", state.dataList);

    let sortingData = reactive([
      { count_num: 15 },
      { count_num: 25 },
      { count_num: 50 },
      { count_num: 100 },
      { count_num: 500 },
      { count_num: 1000 },
    ]);

    return {
      route,
      state,
      sortingData,
      showEditForm,
      deleteItem,
      getDataList,
    };
  },
};
</script>

<style lang="css" scoped>
.table td,
.table th {
  padding: 0.2em !important;
  vertical-align: top;
  border-top: 1px solid #dee2e6;
  font-size: 13px !important;
}
</style>
