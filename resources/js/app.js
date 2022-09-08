import "./bootstrap";
import { createApp } from "vue";
import ElementPlus from "element-plus";
import "element-plus/dist/index.css";
const app = createApp({});
import AddNewEmployee from "./components/AddNewEmployee.vue";
import EmployeeInfo from "./components/EmployeeInfo.vue";

app.component("add-employee", AddNewEmployee);
app.component("employee-info", EmployeeInfo);
app.use(ElementPlus);
app.mount("#app");
