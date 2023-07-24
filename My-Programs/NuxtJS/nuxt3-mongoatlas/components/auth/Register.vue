<template>
  <div class="modal fade" id="staticRegistration" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticRegistrationLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header bg-primary">
            <h1 class="modal-title fs-5 text-white" id="staticRegistrationLabel">Account Registration</h1>
            <button @click="closeRegistration" type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form v-on:submit="submitRegistration">
                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <input type="text" required class="form-control" v-model="regform.firstname" placeholder="enter your First Name"/>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <input type="text" required class="form-control"  v-model="regform.lastname" placeholder="enter your Last Name"/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <input type="email" required class="form-control"  v-model="regform.email" placeholder="enter your Email Address"/>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <input type="text" required class="form-control"  v-model="regform.mobile" placeholder="enter your Mobile No."/>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="mb-3">
                            <input type="text" required class="form-control"  v-model="regform.username" placeholder="enter your username"/>
                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <input type="password" required class="form-control"  v-model="regform.password" placeholder="enter your password"/>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">register</button>
                <button id="regReset" type="reset" class="hide-btn">reset</button>
            </form>
        </div>
        <div class="modal-footer">
            <div id="regMsg" class="w-100 text-center msg"></div>
        </div>
        </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import $ from 'jquery';
import {reactive} from 'vue'

    const regform = reactive({
                lastname: '',
                firstname: '',
                email: '',
                mobile: '',
                username: '',
                password: ''
            });

        function closeRegistration() {
          regform.lastname = '';
          regform.firstname = '';
          regform.email = '';
          regform.mobile = '';
          regform.username = '';
          regform.password = '';
          $("#regReset").click();
        }

        async function submitRegistration(e) {
            e.preventDefault();
            $("#regMsg").text("please wait..");
            await $fetch('/api/auth/signup', {
                headers: {
                    "Content-Type": "application/json",
                },
                method: 'POST',
                body: {
                    'lastname': regform.lastname,
                    'firstname': regform.firstname,
                    'email': regform.email,
                    'mobile': regform.mobile,
                    'username': regform.username,
                    'password': regform.password
                }
            }).then((data) => {

                if (data.statuscode === 200) {
                    $("#regMsg").text(data.message);
                } else {
                    $("#regMsg").text(data.message);
                }

            }).catch( (error) => {
                $("#regMsg").text(error.message);
                window.setTimeout(() => {
                    $("#regMsg").text('');
                },3000);
            });
        }
</script>

<style scoped>
.msg {
    font-size:12px;
    color: red;
}
</style>
