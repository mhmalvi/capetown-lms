<template>
 <div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header">
          <h5>Create Classroom</h5>  
        </div>
        <div class="card-body">
          <form class="needs-validation form" novalidate="" @submit.prevent="processData()">
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="validationCustom02">Title</label>     
                <input class="form-control" type="text" name="title" v-model="state.inputData.title" placeholder="e.g. Jone Doe" required="">
              </div>
              <div class="col-md-6 mb-3">
                <label for="validationCustom02">Section</label>     
                <input class="form-control" type="text" name="section" v-model="state.inputData.section" required="">
              </div>
              <div class="col-md-6 mb-3">
                <label for="validationCustom02">Course</label>     
                <select class="form-control" name="course_category_id" v-model="state.inputData.course_category_id" id="">
                  <option :value="selected" selected>Select Course</option>
                  <option  v-for="(course, index) in courses" :value="course.id" :key="index">{{ course.title }}</option>
                </select>
              </div>
               <div class="col-md-6 mb-3">
                <label for="validationCustom02">Cover Photo</label> 
                <input class="form-control" type="file" name="cover_photo" placeholder="">
              </div>
            </div>
            <!-- <button class="btn btn-primary" type="submit">Submit form</button> -->
            <FormButton :isEdit="state.isEdit" :backUrl="state.backUrl"></FormButton>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</template>

<script>
import { computed, reactive, ref } from '@vue/reactivity'
import useCreate from '../../../../src/composable/use-create'
export default {
   setup(){
     let {processData, editForm, state} = useCreate()
 
    state.generalApi = 'class-room'
    state.backUrl = '/class-room'
    state.isFile = true

   let courses = ref([])
    let selected = reactive('')

    let getCourses = (() => {
       axios.get(state.base_url+'/api/class-room')
       .then(response => {
         courses.value = response.data.data
         
       })
    })()
    
    return{

      processData,
      editForm,
      state,
      courses,
      selected,
      getCourses,
    }
   }
   
}
</script>