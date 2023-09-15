import "./bootstrap";
import { createApp, defineAsyncComponent } from "vue";
import VueSelect from "vue-select";
import BackendError from "./components/Components/BackendError.vue";

const app = createApp({
  components: {
    BooksList: defineAsyncComponent(() =>
      import("@/components/book/BooksList.vue")
    ),
    CategoriesList: defineAsyncComponent(() =>
      import("@/components/category/CategoriesList.vue")
    ),
    AuthorList: defineAsyncComponent(() =>
      import("@/components/author/AuthorList.vue")
    ),
  },
});

app.component("vue-select", VueSelect);
app.component("backend-error", BackendError);
app.mount("#app");
