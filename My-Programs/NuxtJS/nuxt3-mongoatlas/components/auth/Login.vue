<template>
    <div class="modal fade" id="staticLogin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticLoginLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header bg-primary">
            <h1 class="modal-title fs-5 text-white" id="staticLoginLabel">Account Login</h1>
            <button @click="closeLogin" type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" autocomplete="off">
            <form @submit.prevent="submitLogin">
                <div class="mb-3">
                    <input type="text" v-model="form.username" required class="form-control" placeholder="enter your username" :disabled="form.isDisabled"/>
                </div>
                <div class="mb-3">
                    <input type="password" v-model="form.password" required class="form-control" placeholder="enter your password" :disabled="form.isDisabled"/>
                </div>
                <button type="submit" class="btn btn-primary" :disabled="form.isDisabled">login</button>
                <button id="loginReset" type="reset" class="hide-btn">reset</button>
                <button id="mfaBtn" type="submit" class="btn btn-primary mfaBtn" data-bs-toggle="modal" data-bs-target="#staticMFA">mfa</button>


            </form>
        </div>
        <div class="modal-footer">
            <div id="loginMsg" class="w-100 text-center msg"></div>
        </div>
        </div>
    </div>
    </div>
    <authMfa/>
</template>

<script setup lang="ts">

    import nuxtStorage from 'nuxt-storage';
    import $ from 'jquery';
    import {reactive, onMounted} from 'vue'

    const form = reactive({
        username: "",
        password: "",
        isDisabled: false
    });

    onMounted(() => {
        function isDisabled() {
                return !this.activate;
            }
    })

    function closeLogin() {
        form.username = "";
        form.password = "";
        $("#loginReset").click();
    }

    function checkIfImageExists(url, callback) {
        const img = new Image();
        img.src = url;

        if (img.complete) {
        callback(true);
        } else {
        img.onload = () => {
            callback(true);
        };

        img.onerror = () => {
            callback(false);
        };
        }
    }

    async function submitLogin(e) {
        e.preventDefault()
        form.isDisabled=true;
        $("#loginMsg").text("please wait..");
        await $fetch('/api/auth/signin', {
            headers: {
                "Content-Type": "application/json",
            },
            method: 'POST',
            body : {
                username: form.username,
                password: form.password
            }
        }).then((data) => {
            if (data.statuscode === 200) {
                $("#loginMsg").text(data.message);
                nuxtStorage.localStorage.setData('USERID', data.id, 4, 'h');
                nuxtStorage.localStorage.setData('TOKEN', data.token, 4, 'h');

                checkIfImageExists(data.profilepic, (exists) => {
                    if (exists) {
                        nuxtStorage.localStorage.setData('USERPIC', data.profilepic, 4, 'h');
                    } else {
                        nuxtStorage.localStorage.setData('USERPIC', '/users/pix.png', 4, 'h');
                    }
                });

                if (data.qrcodeurl !== '') {
                    closeLogin();
                    $("#mfaBtn").click();
                } else {

                    nuxtStorage.localStorage.setData('USERNAME', data.username, 4, 'h');
                    window.setTimeout(() => {
                        $("#loginReset").click();
                        reloadNuxtApp({path: "/"});
                    },1000);

                }

            } else {
                $("#loginMsg").text(result.message);
                form.isDisabled=false;
                window.setTimeout(() => {
                    $("#loginMsg").text("");
                },3000);
            }
        }).catch( (error) => {
            form.isDisabled=false;
            $("#loginMsg").text("Username not found.");
            window.setTimeout(() => {
                $("#loginMsg").text("");
            },3000);
        });


    }

</script>

<style scoped>
.msg {
    font-size:12px;
    color: red;
}
.mfaBtn {
    visibility: hidden;
}
</style>
