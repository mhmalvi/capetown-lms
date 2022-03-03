<template>
   <TableContent  style="margin-top:-20px;"  :stateProperty="state" :getDataList="getDataList" :showEditForm="showEditForm" :deleteItem="deleteItem"></TableContent>
</template>
<script>
import useGet from '../../../../src/composable/use-get'
export default {

    setup(props,context){
        
        let {getDataList, showEditForm, deleteItem, state} = useGet(context)

        state.generalApi = 'class-room'
        state.cardTitle  = 'ClassRoom'

        getDataList()

        state.table = {
            'Title'      : 'title',
            'Course Name': 'course_name',
            'Section'    : 'section',
            'Cover Photo': 'cover_photo_view',
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