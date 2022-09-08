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
        ElNotification({
            title: "Success",
            message: "Added Success",
            type: "success",
        });
        resetForm();
    }
};
</script>

<template>
    <div>
        <Form
            @submit="submit"
            :validation-schema="schema"
            v-slot="{ errors, isSubmitting }"
        >
            <div class="form-group">
                <label for="name">Name</label>
                <Field
                    type="text"
                    class="form-control"
                    id="name"
                    name="name"
                    aria-describedby="emailHelp"
                    placeholder="Enter name"
                    :class="{ 'is-invalid': errors.name }"
                />
                <span class="text-danger">{{ errors.name }}</span>
            </div>

            <div class="form-group">
                <label for="name">Designation</label>
                <Field
                    type="text"
                    class="form-control"
                    id="name"
                    name="designation"
                    aria-describedby="emailHelp"
                    placeholder="Enter designation"
                    :class="{ 'is-invalid': errors.designation }"
                />
                <span class="text-danger">{{ errors.designation }}</span>
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
</template>
