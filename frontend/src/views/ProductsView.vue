<template>
  <div>

    <div class="center" id="loader" v-if="loading">

      <div class="preloader-wrapper big active">
        <div class="spinner-layer spinner-blue-only">
          <div class="circle-clipper left">
            <div class="circle"></div>
          </div>
          <div class="gap-patch">
            <div class="circle"></div>
          </div>
          <div class="circle-clipper right">
            <div class="circle"></div>
          </div>
        </div>
      </div>

    </div>

    <template v-else>

      <h5>Product List</h5>

      <div class="row">
        <RouterLink to="/add-product" class="btn white black-text btn-small">add product</RouterLink>

        <button class="btn red btn-small right" @click="deleteProducts()" v-if="deleteProductList.length > 0">
          mass delete
        </button>
      </div>

      <div class="row">
        <div class="col s12 m4" v-for="product in products" :key="product.sku">
          <div class="card small">
            <div class="card-content">
              <span class="card-title">{{ product.name }}</span>
              <p>{{ product.product_type }}</p>
              <hr />

              <ul>
                <li v-if="product.product_type === 'dvd'">
                  Size -{{ product.size }}
                </li>
                <li v-if="product.product_type === 'book'">
                  Size - {{ product.weight }}
                </li>
                <li v-if="product.product_type === 'furniture'">
                  Dimensions - {{ product.height }} x {{ product.width }} x
                  {{ product.length }}
                </li>
              </ul>
            </div>
            <div class="card-action">
              <div class="row">
                <div class="col m10">
                  <span>ZMW {{ product.price }}</span>
                </div>
                <div class="col m2">
                  <label>
                    <input class="delete-checkbox" type="checkbox" @click="addId(product.id)" />
                    <span></span>
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </template>

  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      products: [],
      product: {},
      errors: [],
      deleteProductList: [],
      loading: false
    };
  },
  created() {
    this.getProducts();
  },
  methods: {
    async getProducts() {
      this.loading = true;  // set loading to true before making the API call
      try {
        const response = await axios.get("api/products");
        console.log(response);
        this.products = response.data;
      } catch (error) {
        this.errors = error.response.data.errors;
      }

      this.loading = false;  // set loading to false after data has been returned

    },

    async deleteProducts() {
      try {
        let data = JSON.stringify({ products: this.deleteProductList });

        await axios.post("api/delete-products", data);

        this.getProducts();
        this.deleteProductList = [];
        
      } catch (error) {
        this.errors = error.response.data.errors;
      }
    },

    addId(id) {
      if (this.deleteProductList.includes(id)) {
        // Remove the id from the array
        let index = this.deleteProductList.indexOf(id);
        this.deleteProductList.splice(index, 1);
      } else {
        // Add the id to the array
        this.deleteProductList.push(id);
      }
    },
  },
};
</script>

<style scoped>
h5 {
  margin: 40px 0 40px 0;
}

#loader {
  padding: 250px;
}
</style>
