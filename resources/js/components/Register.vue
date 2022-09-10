<script setup>
import { Field, Form } from "vee-validate";
import * as yup from "yup";
import { ElNotification } from "element-plus";

const schema = yup.object({
    name: yup.string().required("Name field is required"),
    email: yup.string().email().required("Email field is required"),
    username: yup.string().required("Username field is required"),
    password: yup.string().required("Password field is required").min(6),
    password_confirmation: yup
        .string()
        .required("Password Confirmation field is required")
        .oneOf(
            [yup.ref("password"), null],
            "Password and confirmation password doesn't match"
        ),
});

const submit = async (values, { setErrors }) => {
    try {
        const res = await axios.post("/register", values);
        if (res.status == 201) {
            window.location.href = "/home";
            ElNotification({
                title: "Success",
                message: "User Registration Success",
                type: "success",
            });
        }
    } catch (error) {
        setErrors(error.response.data.errors);
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
            <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end"
                    >Name</label
                >

                <div class="col-md-6">
                    <Field
                        id="email"
                        type="text"
                        class="form-control"
                        name="name"
                        autofocus
                        placeholder="name"
                        :class="{
                            'is-invalid': errors.name,
                        }"
                    />
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ errors.name }}</strong>
                    </span>
                </div>
            </div>

            <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end"
                    >UserName</label
                >

                <div class="col-md-6">
                    <Field
                        id="email"
                        type="text"
                        class="form-control"
                        name="username"
                        autofocus
                        placeholder="username"
                        :class="{
                            'is-invalid': errors.username,
                        }"
                    />
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ errors.username }}</strong>
                    </span>
                </div>
            </div>

            <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end"
                    >Email</label
                >

                <div class="col-md-6">
                    <Field
                        id="email"
                        type="text"
                        class="form-control"
                        name="email"
                        autofocus
                        placeholder="email"
                        :class="{
                            'is-invalid': errors.email,
                        }"
                    />
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ errors.email }}</strong>
                    </span>
                </div>
            </div>

            <div class="row mb-3">
                <label
                    for="password"
                    class="col-md-4 col-form-label text-md-end"
                    >Password</label
                >

                <div class="col-md-6">
                    <Field
                        id="password"
                        type="password"
                        class="form-control"
                        name="password"
                        placeholder="password"
                        :class="{
                            'is-invalid': errors.password,
                        }"
                    />

                    <span class="invalid-feedback" role="alert">
                        <strong>{{ errors.password }}</strong>
                    </span>
                </div>
            </div>

            <div class="row mb-3">
                <label
                    for="password"
                    class="col-md-4 col-form-label text-md-end"
                    >Confirm Password</label
                >

                <div class="col-md-6">
                    <Field
                        id="password"
                        type="password"
                        class="form-control"
                        name="password_confirmation"
                        placeholder="re-type password"
                        :class="{
                            'is-invalid': errors.password_confirmation,
                        }"
                    />

                    <span class="invalid-feedback" role="alert">
                        <strong>{{ errors.password_confirmation }}</strong>
                    </span>
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button
                        type="submit"
                        class="btn btn-outline rounded-pill"
                        :disabled="isSubmitting"
                    >
                        Register
                        <span
                            v-show="isSubmitting"
                            class="spinner-border spinner-border-sm mr-1"
                        ></span>
                    </button>
                </div>
            </div>
        </Form>
    </div>
</template>
