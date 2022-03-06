<template>
  <TableContent
    style="margin-top: -20px"
    :stateProperty="state"
    :getDataList="getDataList"
    :showEditForm="showEditForm"
    :deleteItem="deleteItem"
  ></TableContent>
</template>

<script>
import useGet from "../../../../src/composable/use-get";

export default {
  setup(props, context) {
    let { getDataList, showEditForm, deleteItem, state } = useGet(context);

    state.generalApi = "unit-topics";
    state.cardTitle = "unit-topics";

    getDataList();

    state.table = {
      Thumbnail: "thumbnail_view",
      Title: "title",
      Type: "type",
      "Created At": "created_at",
    };

    return {
      state,
      showEditForm,
      getDataList,
      deleteItem,
    };
  },
};
</script>
