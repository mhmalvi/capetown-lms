import Home from '../../../components/backend/views/Home.vue'
import SignIn from '../../../components/backend/Authentication/SignIn.vue'
import Category from '../../../components/backend/admin/category/Index.vue'
import CreateCategory from '../../../components/backend/admin/category/Create.vue'

import Course from '../../../components/backend/admin/course/Index.vue'
import CreateCourse from '../../../components/backend/admin/course/Create.vue'

import ClassRoom from '../../../components/backend/admin/classroom/Index.vue'
import CreateClassRoom from '../../../components/backend/admin/classroom/Create.vue'


let routes = [
    {
        path:'/',
        name:'Home',
        component:Home,
        meta:{
            auth:true
        }
    },
    {
        path:'/login',
        name:'SignIn',
        component:SignIn,
        meta:{
            auth:false
        }
    },

    // Course Category
    {
        path:'/course-category',
        name:'Category',
        component:Category,
        meta:{
            auth:true
        }
    },
    {
        path:'/course-category/create',
        name:'CreateCategory',
        component:CreateCategory,
        meta:{
            auth:true
        }
    },
    {
        path:'/course-category/:id',
        name:'CreateCategory',
        component:CreateCategory,
        meta:{
            auth:true
        }
        
    },

    // Course
    {
        path:'/course',
        name:'Course',
        component:Course,
        meta:{
            auth:true
        }
    },
    {
        path:'/course/create',
        name:'CreateCourse',
        component:CreateCourse,
        meta:{
            auth:true
        }
    },
    {
        path:'/course/:id',
        name:'CreateCourse',
        component:CreateCourse,
        meta:{
            auth:true
        }
        
    },

    // Class Room
    {
        path:'/class-room',
        name:'ClassRoom',
        component:ClassRoom,
        meta:{
            auth:true
        }
    },
    {
        path:'/class-room/create',
        name:'CreateClassRoom',
        component:CreateClassRoom,
        meta:{
            auth:true
        }
    },
    {
        path:'/class-room/:id',
        name:'CreateClassRoom',
        component:CreateClassRoom,
        meta:{
            auth:true
        }
        
    },
    {
        path: '/:pathMatch(.*)*',
        redirect: '/',
    },
]

export default routes