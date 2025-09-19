<template>
  <div id="app">
    <AppLayout 
      ref="appLayout"
      :current-view="currentView"
      :brands="brands"
      :selected-brand="selectedBrand"
      :cart-items="cartItems"
      @navigate="handleNavigate"
      @filter-brand="handleFilterBrand"
      @add-to-cart="addToCart"
      @remove-from-cart="removeFromCart"
    >
      <!-- Home Page -->
      <HomePage 
        v-if="currentView === 'home'"
        @view-product="viewProduct"
        @add-to-cart="addToCart"
      />
      
      <!-- Product Details Page -->
      <ProductDetails 
        v-else-if="currentView === 'product-details'" 
        :product-id="currentProductId"
        @back-to-products="goToProducts"
      />
      
      <!-- Privacy Policy Page -->
      <PrivacyPolicy 
        v-else-if="currentView === 'privacy-policy'"
        @back-to-home="goToHome"
      />
      
      <!-- Terms of Service Page -->
      <TermsOfService 
        v-else-if="currentView === 'terms-of-service'"
        @back-to-home="goToHome"
      />
    </AppLayout>
  </div>
</template>

<script>
import axios from 'axios'
import AppLayout from './AppLayout.vue'
import HomePage from './HomePage.vue'
import ProductDetails from './ProductDetails.vue'
import PrivacyPolicy from './PrivacyPolicy.vue'
import TermsOfService from './TermsOfService.vue'

export default {
  name: 'App',
  components: {
    AppLayout,
    HomePage,
    ProductDetails,
    PrivacyPolicy,
    TermsOfService
  },
  data() {
    return {
      currentView: 'home',
      currentProductId: null,
      brands: [],
      selectedBrand: null,
      cartItems: []
    }
  },
  methods: {
    handleNavigate(view) {
      this.currentView = view
      this.currentProductId = null
    },
    handleFilterBrand(brandSlug) {
      this.selectedBrand = brandSlug
      // The HomePage component will handle the filtering
    },
    viewProduct(product) {
      this.currentProductId = product.id
      this.currentView = 'product-details'
    },
    goToProducts() {
      this.currentView = 'home'
      this.currentProductId = null
    },
    goToHome() {
      this.currentView = 'home'
      this.currentProductId = null
    },
    addToCart(product) {
      const existingItem = this.cartItems.find(item => item.id === product.id)
      
      if (!existingItem) {
        this.cartItems.push({ ...product })
        
        // Show cart briefly to give feedback
        if (this.$refs.appLayout) {
          this.$refs.appLayout.showCart = true
          setTimeout(() => {
            this.$refs.appLayout.showCart = false
          }, 2000)
        }
      }
    },
    removeFromCart(product) {
      const index = this.cartItems.findIndex(item => item.id === product.id)
      if (index > -1) {
        this.cartItems.splice(index, 1)
      }
    },
    async loadBrands() {
      try {
        const response = await axios.get('/api/brands')
        this.brands = response.data
      } catch (error) {
        console.error('Error loading brands:', error)
      }
    }
  },
  mounted() {
    this.loadBrands()
  }
}
</script>