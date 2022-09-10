import "./bootstrap";
import { createApp } from "vue";
import ElementPlus from "element-plus";
import "element-plus/dist/index.css";
const app = createApp({});
import AddNewEmployee from "./components/AddNewEmployee.vue";
import EmployeeInfo from "./components/EmployeeInfo.vue";
import login from "./components/Login.vue";

app.component("add-employee", AddNewEmployee);
app.component("employee-info", EmployeeInfo);
app.component("user-login", login);
app.use(ElementPlus);
app.mount("#app");
