<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
    <nav>
    <div class="nav-wrapper black">
      <a href="#!" class="brand-logo"> <i class="material-icons grey-text">redeem</i></a>
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
          <li><RouterLink to="/">Products</RouterLink></li>
      </ul>
    </div>
  </nav>

  <ul class="sidenav" id="mobile-demo">
    <li><RouterLink to="/">Products</RouterLink></li>
  </ul>


<main>

  <div class="container">
  <RouterView />
</div>


</main>


<footer class="page-footer black">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Product Store</h5>
                <p class="grey-text text-lighten-4">Excellence in product offering.</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="#!">Home</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Products</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2022 
            <a class="grey-text text-lighten-4 right" href="#!"></a>
            </div>
          </div>
        </footer>



</template>

<style scoped>
  .brand-logo {
    margin-left: 20px;
  }
</style>


