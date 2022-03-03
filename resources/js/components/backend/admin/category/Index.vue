<template>
   <TableContent  style="margin-top:-20px;"  :stateProperty="state" :getDataList="getDataList" :showEditForm="showEditForm" :deleteItem="deleteItem"></TableContent>
</template>
<script>
import useGet from '../../../../src/composable/use-get'
export default {

    setup(props,context){
        
        let {getDataList, showEditForm, deleteItem, state} = useGet(context)

        state.generalApi = 'course-category'
        state.cardTitle  = 'Course Category'

        getDataList()

        state.table = {
            'Name':'name',
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