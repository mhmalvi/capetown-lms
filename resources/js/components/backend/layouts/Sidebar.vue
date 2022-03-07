<template>
  <div class="mdk-drawer js-mdk-drawer" id="default-drawer">
    <div class="mdk-drawer__content">
      <div
        class="sidebar sidebar-dark-pickled-bluewood sidebar-left"
        data-perfect-scrollbar
      >
        <!-- Sidebar Content -->

        <div class="d-flex align-items-center navbar-height">
          <form
            action="index.html"
            class="search-form search-form--black mx-16pt pr-0 pl-16pt"
          >
            <input type="text" class="form-control pl-0" placeholder="Search" />
            <button class="btn" type="submit">
              <i class="material-icons">search</i>
            </button>
          </form>
        </div>

        <router-link to="/" class="sidebar-brand">
          <!-- <img class="sidebar-brand-icon" :src="image_url+'/image/images/illustration/student/128/white.svg'" alt="Luma"> -->

          <span class="avatar avatar-xl sidebar-brand-icon h-auto">
            <span class="avatar-title rounded bg-primary"
              ><img
                :src="image_url + '/images/logo/white-100@2x.png'"
                class="img-fluid"
                alt="logo"
            /></span>
          </span>

          <span>Luma</span>
        </router-link>

        <div class="sidebar-heading">Courses</div>
        <ul class="sidebar-menu">
          <li class="sidebar-menu-item" :class="{ active: path == '/' }">
            <router-link class="sidebar-menu-button" to="/">
              <span
                class="material-icons sidebar-menu-icon sidebar-menu-icon--left"
                >home</span
              >
              <span class="sidebar-menu-text">Home</span>
            </router-link>
          </li>

          <li
            class="sidebar-menu-item"
            :class="{ active: path == '/course-category' }"
            v-if="isAdmin"
          >
            <router-link class="sidebar-menu-button" to="/course-category">
              <span
                class="material-icons sidebar-menu-icon sidebar-menu-icon--left"
                >account_box</span
              >
              <span class="sidebar-menu-text">Category</span>
            </router-link>
          </li>
          <li
            class="sidebar-menu-item"
            :class="{ active: path == '/class-room' }"
            v-if="isAdmin"
          >
            <router-link class="sidebar-menu-button" to="/class-room">
              <span
                class="material-icons sidebar-menu-icon sidebar-menu-icon--left"
                >room</span
              >
              <span class="sidebar-menu-text">Class Room</span>
            </router-link>
          </li>
          <li
            class="sidebar-menu-item"
            :class="{ active: path == '/course' }"
            v-if="isAdmin"
          >
            <router-link class="sidebar-menu-button" to="/course">
              <span
                class="material-icons sidebar-menu-icon sidebar-menu-icon--left"
                >class</span
              >
              <span class="sidebar-menu-text">Course</span>
            </router-link>
          </li>
          <li
            class="sidebar-menu-item"
            :class="{ active: path == '/course-units' }"
            v-if="isAdmin"
          >
            <router-link class="sidebar-menu-button" to="/course-units">
              <span
                class="material-icons sidebar-menu-icon sidebar-menu-icon--left"
                >class</span
              >
              <span class="sidebar-menu-text">Course Units</span>
            </router-link>
          </li>

          <li class="sidebar-menu-item" v-if="isStudent">
            <a class="sidebar-menu-button" href="#">
              <span
                class="material-icons sidebar-menu-icon sidebar-menu-icon--left"
                >class</span
              >
              <span class="sidebar-menu-text">Courses</span>
            </a>
            <ul class="sidebar-menu pl-2">
              <li class="sidebar-menu-item">
                <router-link
                  class="sidebar-menu-button"
                  :to="{
                    name: 'CourseView',
                    params: {
                      id: course.id,
                    },
                  }"
                  v-for="(course, index) in courses"
                  :key="index"
                >
                  <span
                    class="
                      material-icons
                      sidebar-menu-icon sidebar-menu-icon--left
                    "
                    >class</span
                  >
                  <span class="sidebar-menu-text">{{ course.title }}</span>
                </router-link>
              </li>
            </ul>
          </li>
        </ul>

        <!-- // END Sidebar Content -->
      </div>
    </div>
  </div>
</template>
<script>
import { inject, ref, computed, onMounted } from "vue";
import { useRoute } from "vue-router";
import useCourse from "../../../src/composable/useCourse";

export default {
  setup() {
    let image_url = inject("image_url");

    let route = useRoute();
    const user = inject("user");

    const isAdmin = computed(() => user.type == "admin");
    const isStudent = computed(() => user.type == "student");

    const courses = ref([]);

    const path = computed(() => route.path);

    onMounted(() => {
      if (isStudent.value) {
        useCourse()
          .all()
          .then((res) => {
            courses.value = res.data.data;
          });
      }
    });

    return {
      image_url,
      path,
      user,
      isAdmin,
      isStudent,
      courses,
    };
  },
};
</script>
