require("../../../bootstrap");
import { createApp, h } from "vue";
import axios from "axios";
import master from "../../../Components/Backend/Layouts/Master.vue";
import router from "../routes/router-config-admin";
import store from "../store/store";

import PulseLoader from "vue-spinner/src/PulseLoader.vue";
import Pagination from "v-pagination-3";

import VueSweetalert2 from "vue-sweetalert2";
import "sweetalert2/dist/sweetalert2.min.css";

import PrimeVue from "primevue/config";
import ToastService from "primevue/toastservice";
import Toast from "primevue/toast";
import Button from "primevue/button";
import InputText from "primevue/inputtext";

import "primevue/resources/themes/saga-blue/theme.css"; //theme
import "primevue/resources/primevue.min.css"; //core css
import "primeicons/primeicons.css"; //icons

import FormButton from "../../../components/backend/layouts/FormButton.vue";
import TableContent from "../../../components/backend/layouts/TableContent.vue";

const app = createApp({
  created() {
    const userInfo = localStorage.getItem("user");
    if (userInfo) {
      const userData = JSON.parse(userInfo);
      this.$store.commit("setUserData", userData);
    }
    axios.interceptors.response.use(
      (response) => response,
      (error) => {
        if (error.response.status === 401) {
          this.$store.dispatch("signOut");
        }
        return Promise.reject(error);
      }
    );
  },
  render: () => h(master),
});

app.component("FormButton", FormButton);
app.component("TableContent", TableContent);

app.component("PulseLoader", PulseLoader);

app.component("pagination", Pagination);

app.component("Toast", Toast);
app.component("Button", Button);
app.component("InputText", InputText);

app.provide("base_url", window.location.origin);
app.provide("image_url", window.location.origin);

let userInfo = localStorage.getItem("user");
let user = JSON.parse(userInfo);
app.provide("user", user);
app.use(store);
app.use(router);
app.use(VueSweetalert2);
app.use(PrimeVue);
app.use(ToastService);
app.mount("#app_admin");
