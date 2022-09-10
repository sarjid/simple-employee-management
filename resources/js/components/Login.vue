<script setup>
import { Field, Form } from "vee-validate";
import * as yup from "yup";
import { ElNotification } from "element-plus";

const schema = yup.object({
    username: yup.string().required("Username field is required"),
    password: yup.string().required("Password field is required"),
});

const submit = async (values, { setErrors }) => {
    try {
        const res = await axios.post("/login", values);
        if (res.status === 204) {
            window.location.href = "/home";
            ElNotification({
                title: "Success",
                message: "Login Success",
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
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="remember"
                            id="remember"
                        />

                        <label class="form-check-label" for="remember">
                            Remember Me
                        </label>
                    </div>
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button
                        type="submit"
                        class="btn btn-outline rounded-pill"
                        :disabled="isSubmitting"
                    >
                        Login
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
