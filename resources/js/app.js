import "./bootstrap";
import { createApp, defineAsyncComponent } from "vue";
import VueSelect from "vue-select";

const app = createApp({
  components: {
    BooksList: defineAsyncComponent(() =>
      import("@/components/books/BooksList.vue")
    ),
  },
});

app.component("VueSelect", VueSelect);
app.mount("#app");
