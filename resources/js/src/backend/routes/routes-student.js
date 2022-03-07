import Home from "../../../components/backend/views/Home.vue";
import SignIn from "../../../components/backend/Authentication/SignIn.vue";
let routes = [
  {
    path: "/",
    name: "Home",
    component: Home,
    meta: {
      auth: true,
    },
  },
  {
    path: "/login",
    name: "SignIn",
    component: SignIn,
    meta: {
      auth: false,
    },
  },
  {
    path: "/course",
    name: "Courses",
    component: () =>
      import("../../../components/backend/student/course/Index.vue"),
    meta: {
      auth: true,
    },
  },
  {
    path: "/course/:id/view",
    name: "CourseView",
    component: () =>
      import("../../../components/backend/student/course/View.vue"),
    meta: {
      auth: true,
    },
  },
  {
    path: "/course/:course_id/unit/:unit_id",
    name: "UnitTopicsView",
    component: () =>
      import("../../../components/backend/student/course/UnitTopics.vue"),
    meta: {
      auth: true,
    },
  },
];

export default routes;
