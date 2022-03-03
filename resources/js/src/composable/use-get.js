import { reactive, computed } from "vue"
import useUtility from "./use-utility"
import { useRoute, useRouter } from "vue-router"
import { useToast } from "primevue/usetoast";
export default function useGet(context){

    let router    = useRouter()
    let route     = useRoute()
    let {state}   = useUtility()
    const toast = useToast();

    let getDataList = ((page = 1) => {
        
    let api_path = state.base_url+'/api/'+state.generalApi+'?page='+page
    
    axios.get(api_path)
    .then(response => {
        
        if(response.status == 200){
             
            state.dataList = response.data  
        
        }
           
    })
    .catch(error => {
        if (error.response.status == 422) {
            state.errors = error.response.data.errors;
        } else {
            // state.toastMessage('error',error, 'check', '', 'times')
        }
    })
    .finally(() => {

    })

    })


    let showEditForm = (id) => {
        let api = state.generalApi != null?state.generalApi:state.getApi

        router.push({ path: route.path+'/'+id })
        
        
    }


    // showEditForm()

    let deleteItem = (i,j) => {
       

        /*   j = When you have to delete a single image from multiple image during edit 
           then this 'j' parameter passed image id and it helps to delete image item from it's table*/

            // let message = this.dialogConfig().message
            // let options = this.dialogConfig().options
            
            // this.$dialog.confirm(message, options)

            // .then(res => {

                let api = state.generalApi != null?state.generalApi:state.getApi
                
                let api_path = state.url+'/api/'+api+'/'+i+'?optional_id='+j

                axios.delete(api_path)
                .then(response => {
                    
                    // this.toastMessage('error', response.data.message)
                    getDataList()
                    // this.generalSettings()

                })
                .catch(error => {
                    // this.toastMessage('error', error.response.data.message,'times')
                })

            // })
            // .catch(error => {
            //     // this.toastMessage('success', 'Thanks for keeping me safe!')
            // });
           
        }



    return{
        route,
        router,
        getDataList,
        showEditForm,
        deleteItem,
        state,

    }
    
}