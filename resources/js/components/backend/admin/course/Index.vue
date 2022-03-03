<template>
   <TableContent  style="margin-top:-20px;"  :stateProperty="state" :getDataList="getDataList" :showEditForm="showEditForm" :deleteItem="deleteItem"></TableContent>
</template>
<script>
import useGet from '../../../../src/composable/use-get'
export default {

    setup(props,context){
        
        let {getDataList, showEditForm, deleteItem, state} = useGet(context)

        state.generalApi = 'course'
        state.cardTitle  = 'Course'

        getDataList()

        state.table = {
            'Title':'title',
            'Code':'code',
            'Category':'course_category_name',
            'Thumbnail':'thumbnail_view',
        }

        return{
        state,
        showEditForm,
        getDataList,
        deleteItem,
        }
    },

}
</script>