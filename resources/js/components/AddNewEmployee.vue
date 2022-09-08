<script setup>
import { ElNotification } from "element-plus";
import axios from "axios";
import { Field, Form } from "vee-validate";
import * as yup from "yup";

const schema = yup.object({
    name: yup.string().required("Name field is required"),
    designation: yup.string().required("Designation field is required"),
});
const submit = async (values, { resetForm }) => {
    const res = await axios.post("/employee", values);
    if (res.status === 200) {
        var oTable = $(".data-table").dataTable();
        oTable.fnDraw();

        ElNotification({
            title: "Success",
            message: "Added Success",
            type: "success",
        });
        resetForm();
        $(".close").click();
    }
};
</script>

<template>
    <div>
        <button
            type="button"
            class="btn btn-danger rounded-pill"
            data-toggle="modal"
            data-target="#createModal"
            style="float: right"
        >
            Add New
        </button>
        <div
            class="modal fade"
            id="createModal"
            tabindex="-1"
            role="dialog"
            aria-labelledby="createModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title cs" id="createModalLabel">
                            Add New Employee
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <Form
                            @submit="submit"
                            :validation-schema="schema"
                            v-slot="{ errors, isSubmitting }"
                        >
                            <div class="form-group">
                                <label for="name" class="cs">Name</label>
                                <Field
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    name="name"
                                    aria-describedby="emailHelp"
                                    placeholder="Enter name"
                                    :class="{ 'is-invalid': errors.name }"
                                />
                                <span class="text-danger">{{
                                    errors.name
                                }}</span>
                            </div>

                            <div class="form-group">
                                <label for="name" class="cs">Designation</label>
                                <Field
                                    type="text"
                                    class="form-control"
                                    id="name"
                                    name="designation"
                                    aria-describedby="emailHelp"
                                    placeholder="Enter designation"
                                    :class="{
                                        'is-invalid': errors.designation,
                                    }"
                                />
                                <span class="text-danger">{{
                                    errors.designation
                                }}</span>
                            </div>

                            <button
                                type="submit"
                                class="btn btn-info mt-2"
                                :disabled="isSubmitting"
                            >
                                Submit
                                <span
                                    v-show="isSubmitting"
                                    class="spinner-border spinner-border-sm mr-1"
                                ></span>
                            </button>
                        </Form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
.cs {
    color: black;
}
</style>
