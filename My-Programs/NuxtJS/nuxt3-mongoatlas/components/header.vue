<template>
<nav class="navbar navbar-expand-lg bgx">
  <div class="container-fluid">
    <NuxtLink class="navbar-brand" to="/"><img class="logo" src="/images/logo.png" alt="logo" /></NuxtLink>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <NuxtLink class="nav-link text-white active" to="/aboutus">About Us</NuxtLink>
        </li>
        <li class="nav-item dropdown">
              <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Services
              </a>
              <ul class="dropdown-menu">
                <li><NuxtLink class="dropdown-item" to="/services">Product Delivery</NuxtLink></li>
                <li><NuxtLink class="dropdown-item" to="/services">Home Service</NuxtLink></li>
                <li><hr class="dropdown-divider"></li>
                <li><NuxtLink class="dropdown-item" to="/services">Call Center</NuxtLink></li>
              </ul>
            </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Products
          </a>
          <ul class="dropdown-menu">
            <li><NuxtLink class="dropdown-item" to="/products/list">Electronics</NuxtLink></li>
            <li><NuxtLink class="dropdown-item" to="/products/catalog">Catalogs</NuxtLink></li>
            <li><hr class="dropdown-divider"></li>
            <li><NuxtLink class="dropdown-item" to="/products/search">Search Product</NuxtLink></li>
          </ul>
        </li>
        <li class="nav-item">
          <NuxtLink class="nav-link active text-white" to="/contactus">Contact Us</NuxtLink>
        </li>
      </ul>

        <div v-if="data.username">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <img class="user" :src="data.userpic" alt=""/>
                {{ data.username }}
              </a>
              <ul class="dropdown-menu">
                <li><a @click="logout" class="dropdown-item" href="/#">LogOut</a></li>
                <li><NuxtLink class="dropdown-item" to="/profile">Profile</NuxtLink></li>
                <li><hr class="dropdown-divider"></li>
                <li><NuxtLink class="dropdown-item" to="/#">Messenger</NuxtLink></li>
              </ul>
            </li>
          </ul>
        </div>
        <ul v-else class="navbar-nav mr-auto">
            <li class="nav-item">
              <NuxtLink class="nav-link active text-white" to="/#" data-bs-toggle="modal" data-bs-target="#staticLogin">Login</NuxtLink>
            </li>
            <li class="nav-item">
              <NuxtLink class="nav-link active text-white" to="/#" data-bs-toggle="modal" data-bs-target="#staticRegistration">Register</NuxtLink>
            </li>        
        </ul>


    </div>
  </div>
</nav>

  <!-- OFF CANVAS -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header bg-primary">
      <h5 class="offcanvas-title text-white" id="offcanvasExampleLabel">Drawer Menu</h5>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
  
      <ul class="nav flex-column">
        <li class="nav-item" data-bs-dismiss="offcanvas">
          <NuxtLink class="nav-link active" to="/aboutus">About Us</NuxtLink>
        </li>
        <li><hr/></li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Services
          </a>
          <ul class="dropdown-menu">
            <li data-bs-dismiss="offcanvas"><NuxtLink class="dropdown-item" to="/services">Product Delivery</NuxtLink></li>
            <li data-bs-dismiss="offcanvas">
              <li><NuxtLink class="dropdown-item" to="/services">Home Service</NuxtLink></li>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li data-bs-dismiss="offcanvas">
              <li><NuxtLink class="dropdown-item" to="/services">Call Center</NuxtLink></li>
            </li>
          </ul>
        </li>        
        <li><hr/></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Products
          </a>
          <ul class="dropdown-menu">
            <li data-bs-dismiss="offcanvas"><NuxtLink class="dropdown-item" to="/products/list">Electronics</NuxtLink></li>
            <li data-bs-dismiss="offcanvas">
              <li><NuxtLink class="dropdown-item" to="/products/catalog">Catalogs</NuxtLink></li>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li data-bs-dismiss="offcanvas">
              <li><NuxtLink class="dropdown-item" to="/products/search">Search Product</NuxtLink></li>
            </li>
          </ul>
        </li>
        <li><hr/></li>

  
        <li class="nav-item" data-bs-dismiss="offcanvas">
          <NuxtLink class="nav-link active" to="/contactus">Contact Us</NuxtLink>  
        </li>
        <li><hr/></li>
  
        <div v-if="data.username">
          <ul class="nav">
  
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img class="user" :src="data.userpic" />&nbsp;{{data.username}}
            </a>
            <ul class="dropdown-menu">
              <li data-bs-dismiss="offcanvas"><NuxtLink @click="logout" class="dropdown-item" to="#">Logout</NuxtLink></li>
              <li data-bs-dismiss="offcanvas"><NuxtLink class="dropdown-item" to="/profile">Profile</NuxtLink></li>
              <li><hr class="dropdown-divider"></li>
              <li data-bs-dismiss="offcanvas"><NuxtLink class="dropdown-item" to="/#">Messenger</NuxtLink></li>
            </ul>
          </li>
        </ul>          
        <li><hr/></li>
  
        </div>
  
        <div v-if="!data.username">
          <ul class="nav flex-column">
  
          <li data-bs-dismiss="offcanvas" class="nav-item">
            <a class="nav-link active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#staticLogin">Login</a>
          </li>
          <li><hr/></li>
  
          <li data-bs-dismiss="offcanvas" class="nav-item">
            <a class="nav-link active" aria-current="page" href="#" data-bs-toggle="modal" data-bs-target="#staticRegistration">Register</a>
          </li>     
          <li><hr/></li>
                 
          </ul>
        </div>
  
      </ul>
  
    </div>
  </div>

<AuthLogin/>
<AuthRegister/>
</template>

<script setup lang="ts">
  import nuxtStorage from 'nuxt-storage';
  import {reactive, onMounted} from 'vue'

    const data = reactive({
        username: '',
        userpic: ''
      });

      onMounted(() => {
        data.username = nuxtStorage.localStorage.getData('USERNAME');
        data.userpic = nuxtStorage.localStorage.getData('USERPIC');
      });

      function logout(e) {
          e.preventDefault();
          nuxtStorage.localStorage.clear();
          window.setTimeout(() => {
            reloadNuxtApp({path: "/"});
          },1000);


      }

</script>

<style scoped>
  #offcanvasExample {
    max-width: 70%!important;
  }
</style>

