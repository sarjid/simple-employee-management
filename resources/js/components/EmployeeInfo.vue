<script setup>
import Pagination from "laravel-vue-pagination";
import { ElNotification } from "element-plus";
import axios from "axios";
import { ref, onMounted, watch } from "vue";
const employees = ref([]);
const selectedData = ref([]);
const limit = ref(5);
const search = ref("");
const getData = async (page = 1) => {
    try {
        let res = await axios.get(
            `/employee-list?page=${page}&search=${search.value}&limit=${limit.value}`
        );
        if (res.status === 200) {
            employees.value = res.data;
        }
    } catch (error) {
        console.log(error);
    }
};

watch(
    () => [...search.value],
    (currentValue, oldValue) => {
        getData();
    }
);

const addData = (data) => {
    selectedData.value.includes(data)
        ? (selectedData.value = selectedData.value.filter(
              (item) => item != data.id
          ))
        : selectedData.value.unshift(data);
};

const deleteData = (data) => {
    let index = selectedData.value.findIndex((el) => el.id === data.id);
    selectedData.value.splice(index, 1);
};

const StoreData = async () => {
    try {
        let res = await axios.post("/employeeinfo", {
            form: selectedData.value,
        });
        if (res.status === 200) {
            ElNotification({
                title: "Success",
                message: "Added Success",
                type: "success",
            });

            // selectedData.value = [];
        }
    } catch (error) {
        console.log(error);
    }
};

onMounted(() => {
    getData();
});
</script>
<template>
    <div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-4">
                        <select
                            class="px-4 rounded-pill"
                            name=""
                            id=""
                            v-model="limit"
                            @change="getData"
                        >
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>

                    <div class="col-md-4"></div>

                    <div class="col-md-4">
                        <input
                            type="search"
                            class="form-control rounded-pill"
                            placeholder="search here..."
                            v-model="search"
                            @keyup="getData"
                        />
                    </div>
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Designation</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    {{
                        selectedData
                    }}
                    <tbody v-if="employees.data">
                        <tr v-for="(emp, index) in employees.data" :key="index">
                            <td>{{ emp.name }}</td>
                            <td>{{ emp.designation }}</td>
                            <td>
                                <a
                                    href="javascript::void(0)"
                                    class="btn-sm btn btn-outline rounded-pill"
                                    @click.prevent="addData(emp)"
                                    ><span class="fa fa-plus"></span
                                ></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <span v-if="employees.data">
                    <el-empty
                        v-show="employees.data.length == 0"
                        :image-size="80"
                        class="text-center"
                    />
                </span>
            </div>

            <div class="card-footer">
                <Pagination
                    :data="employees"
                    @pagination-change-page="getData"
                    align="right"
                />
            </div>
        </div>

        <div class="card mt-3" v-if="selectedData.length > 0">
            <div class="card-header">Selected Data</div>

            <div class="card-body">
                <form @submit.prevent="StoreData">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Address</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="data in selectedData" :key="data.id">
                                <th>
                                    <input
                                        type="text"
                                        class="form-control"
                                        readonly
                                        :placeholder="data.name"
                                    />
                                </th>
                                <td>
                                    <input
                                        type="text"
                                        class="form-control"
                                        placeholder="address"
                                        v-model="data.address"
                                    />
                                </td>

                                <td>
                                    <input
                                        type="text"
                                        placeholder="phone"
                                        class="form-control"
                                        v-model="data.phone"
                                    />
                                </td>

                                <td>
                                    <input
                                        type="text"
                                        placeholder="email"
                                        class="form-control"
                                        v-model="data.email"
                                    />
                                </td>
                                <td>
                                    <a
                                        href="javascript::void(0)"
                                        class="btn-sm btn btn-outline rounded-pill"
                                        @click="deleteData(data)"
                                        ><span class="fa fa-minus"></span
                                    ></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button
                        class="btn btn-outline rounded-pill mt-2"
                        style="float: right"
                    >
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>
