import "./bootstrap";
import { createApp, defineAsyncComponent } from "vue";
import VueSelect from "vue-select";
import BackendError from "./components/Components/BackendError.vue";

const app = createApp({
  components: {
    BooksList: defineAsyncComponent(() =>
      import("@/components/books/BooksList.vue")
    ),
  },
});

app.component("vue-select", VueSelect);
app.component("backend-error", BackendError);
app.mount("#app");
