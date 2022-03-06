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
import { useRouter } from "vue-router";

export default {
  setup(props, context) {
    let { getDataList, showEditForm, deleteItem, state } = useGet(context);
    const router = useRouter();

    state.generalApi = "course-units";
    state.cardTitle = "Course Units";

    state.customActions = [
      {
        fn: (item) => {
          router.push("/course-units/" + item.id + "/topics");
        },
        classes: "btn-primary",
        icon_classes: "fas fa-list",
      },
    ];

    getDataList();

    state.table = {
      Thumbnail: "thumbnail_view",
      Title: "title",
      Course: "course",
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
