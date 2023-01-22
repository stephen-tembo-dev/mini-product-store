<template>
  <div>
    <h5>Add Product</h5>

    <div id="formWrapper" class="row card">
      <form id="#product_form" class="col s12" @submit.prevent="addProduct">
        <div class="row">
          <p class="labelHeading" id="#productType"> Product Switcher</p>
          <div class="input-field col s12">
            <select class="browser-default" v-model="product.productType">
              <option disabled selected>Product type</option>
              <option value="DVD">DVD</option>
              <option value="Book">Book</option>
              <option value="Furniture">Furniture</option>
            </select>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <input id="#sku" required type="text" v-model="product.sku" />
            <label>SKU</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s12">
            <input id="#name" required type="text" v-model="product.name" />
            <label>Product name</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="#price" required type="number" class="validate" v-model="product.price" />
            <label>Price</label>
          </div>
        </div>

        <template v-if="product.productType === 'DVD'">
          <div class="row">
            <div class="input-field col s12">
              <input id="#size" type="number" class="validate" v-model="product.size" />
              <label>Please provide, size</label>
            </div>
          </div>
        </template>

        <template v-if="product.productType === 'Book'">
          <div class="row">
            <div class="input-field col s12">
              <input id="#weight" type="number" class="validate" v-model="product.weight" />
              <label>Please provide, weight</label>
            </div>
          </div>
        </template>

        <template v-if="product.productType === 'Furniture'">
          <div class="row">
            <div class="input-field col s12">
              <input id="#length" type="number" class="validate" v-model="product.length" />
              <label>Please provide, dimension</label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s12">
              <input id="#width" type="number" class="validate" v-model="product.width" />
              <label>Please provide, dimension</label>
            </div>
          </div>

          <div class="row">
            <div class="input-field col s12">
              <input id="#height" type="number" class="validate" v-model="product.height" />
              <label>Please provide, dimension</label>
            </div>
          </div>
        </template>

        <button type="submit" class="btn btn-small">Save</button>
        <button type="button" @click="cancel()" class="btn btn-small white black-text cancel">Cancel</button>

      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      product: {
        sku: null,
        name: null,
        productType: null,
        price: null,
        size: null,
        length: null,
        height: null,
        width: null,
        weight: null,
      },
      errors: [],
      deleteProductList: [],
    };
  },

  methods: {

    async addProduct() {

      let valid = this.validateInputs();

      if(!valid){
        return 0;
      }

      try {

        let data = JSON.stringify({
          sku: this.product.sku,
          name: this.product.name,
          productType: this.product.productType,
          price: this.product.price,
          size: this.product.size,
          length: this.product.length,
          width: this.product.width,
          height: this.product.height,
          weight: this.product.weight
        });

        const response = await axios.post("api/add-product", data);

        M.toast({html: 'Product added successfully'});
        
        this.$router.push({ name: 'products' });

      } catch (error) {
        this.errors = error.response.data.errors;
        console.log(this.errors);
      }
    },

    cancel() {
      this.$router.push({ name: 'products' });
    },

    validateInputs() {
      if (this.product.productType === 'dvd') {
        if (!(this.product.size > 0)) {
          M.toast({html: 'invalid value in size field'})
          return false;
        }
      } else if (this.product.productType === 'book') {
        if (!(this.product.weight > 0)) {
          M.toast({html: 'invalid value in weight field'})
          return false;
        }
      } else if (this.product.productType === 'furniture') {
        if (!(this.product.length > 0 && this.product.width > 0 && this.product.height > 0)) {
          M.toast({html: 'invalid value in length, width, and height fields'})
          return false;
        }
      }

      return true;

    },

    getRandomInt(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1)) + min; 
  }





  },
};
</script>

<style scoped>
h5 {
  margin: 40px 0 40px 0;
}

#formWrapper {
  padding: 15px;
  border-radius: 20px;
}

.labelHeading {
  margin-left: 16px;
}

.btn {
  border-radius: 10px;
}

.cancel {
  margin-left: 15px;
}
</style>


