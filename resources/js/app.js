import "./bootstrap";
import { createApp } from "vue";
import ElementPlus from "element-plus";
import "element-plus/dist/index.css";
const app = createApp({});
import AddNewEmployee from "./components/AddNewEmployee.vue";

app.component("add-new-employee", AddNewEmployee);
app.use(ElementPlus);
app.mount("#app");
