<template>
  <div id="app">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
          <div class="flex items-center">
            <img src="/images/logo.webp" alt="TEC HOUSE" class="h-10 w-10 mr-3" />
            <h1 class="text-2xl font-bold text-gray-900">TEC HOUSE</h1>
          </div>
          
          <!-- Brand Navigation -->
          <div class="flex items-center space-x-6">
            <button 
              @click="selectedBrand = null"
              :class="[
                'px-3 py-2 text-sm font-medium transition-colors',
                selectedBrand === null 
                  ? 'text-gray-900 border-b-2 border-gray-900' 
                  : 'text-gray-500 hover:text-gray-700'
              ]"
            >
              All Brands
            </button>
            <button 
              v-for="brand in brands" 
              :key="brand.id"
              @click="selectedBrand = brand.slug"
              :class="[
                'px-3 py-2 text-sm font-medium transition-colors',
                selectedBrand === brand.slug 
                  ? 'text-gray-900 border-b-2 border-gray-900' 
                  : 'text-gray-500 hover:text-gray-700'
              ]"
            >
              {{ brand.name }}
            </button>
          </div>

          <!-- Cart -->
          <div class="flex items-center">
            <button 
              @click="showCart = !showCart"
              class="relative p-2 text-gray-600 hover:text-gray-900"
            >
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6-5v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6m8 0V9a2 2 0 00-2-2H9a2 2 0 00-2 2v4.01" />
              </svg>
              <span v-if="cartItems.length > 0" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                {{ cartItems.length }}
              </span>
            </button>
          </div>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <main class="bg-white">
      <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900">Latest Tech Products</h2>

        <!-- Search -->
        <div class="mt-6">
          <input 
            v-model="searchQuery"
            type="text" 
            placeholder="Search products..."
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-500 focus:border-transparent"
          />
        </div>

        <!-- Products Grid -->
        <div v-if="loading" class="mt-6 text-center py-12">
          <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-gray-600"></div>
          <p class="mt-2 text-gray-600">Loading products...</p>
        </div>

        <div v-else-if="products.length === 0" class="mt-6 text-center py-12">
          <p class="text-gray-600 text-lg">No products found.</p>
        </div>

        <div v-else class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
          <div v-for="product in products" :key="product.id" class="group relative">
            <img 
              :src="productImage(product)" 
              :alt="product.name" 
              class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80" 
            />
            <div class="mt-4 flex justify-between">
              <div>
                <h3 class="text-sm text-gray-700">
                  <a :href="'#'" @click.prevent="viewProduct(product)">
                    <span aria-hidden="true" class="absolute inset-0" />
                    {{ product.name }}
                  </a>
                </h3>
                <p class="mt-1 text-sm text-gray-500">{{ product.brand.name }}</p>
              </div>
              <div class="text-right">
                <p class="text-sm font-medium text-gray-900 flex items-center justify-end">
                  <RfSymbol class="w-4 h-4 mr-1" />
                  {{ formatPrice(product.price) }}
                </p>
                <button 
                  @click="addToCart(product)"
                  class="mt-1 text-xs text-gray-500 hover:text-gray-700"
                >
                  Add to cart
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <!-- Cart Sidebar -->
    <div v-if="showCart" class="fixed inset-0 z-50 overflow-hidden">
      <div class="absolute inset-0 bg-black bg-opacity-50" @click="showCart = false"></div>
      <div class="absolute right-0 top-0 h-full w-96 bg-white shadow-xl">
        <div class="flex h-full flex-col">
          <div class="flex items-center justify-between p-4 border-b">
            <h2 class="text-lg font-semibold">Shopping Cart</h2>
            <button @click="showCart = false" class="text-gray-500 hover:text-gray-700">
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          
          <div class="flex-1 overflow-y-auto p-4">
            <div v-if="cartItems.length === 0" class="text-center py-8">
              <p class="text-gray-500">Your cart is empty</p>
            </div>
            <div v-else>
              <div v-for="item in cartItems" :key="item.id" class="flex items-center space-x-4 py-4 border-b">
                <img :src="productImage(item)" :alt="item.name" class="h-16 w-16 rounded object-cover" />
                <div class="flex-1">
                  <h3 class="text-sm font-medium">{{ item.name }}</h3>
                  <p class="text-sm text-gray-500">{{ item.brand.name }}</p>
                  <p class="text-sm font-medium flex items-center">
                    <RfSymbol class="w-3 h-3 mr-1" />
                    {{ formatPrice(item.price) }}
                  </p>
                </div>
                <button @click="removeFromCart(item)" class="text-red-500 hover:text-red-700">
                  <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                  </svg>
                </button>
              </div>
            </div>
          </div>
          
          <div v-if="cartItems.length > 0" class="border-t p-4">
            <div class="flex justify-between text-lg font-semibold mb-4">
              <span>Total:</span>
              <span class="flex items-center">
                <RfSymbol class="w-5 h-5 mr-1" />
                {{ formatPrice(cartTotal) }}
              </span>
            </div>
            <button class="w-full bg-gray-900 text-white py-2 px-4 rounded-md hover:bg-gray-800">
              Checkout
            </button>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 py-6 mt-12">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center text-sm text-gray-600">
          <div class="mb-2">
            <a href="tel:7771811" class="hover:text-gray-900 transition-colors mr-4">7771811</a>
            <span class="text-gray-400">|</span>
            <a href="tel:7332211" class="hover:text-gray-900 transition-colors ml-4">7332211</a>
          </div>
          <div class="text-xs text-gray-500">
            © 2024 TecHouse. All rights reserved.
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
import axios from 'axios'
import RfSymbol from './rf.vue'

export default {
  name: 'App',
  components: {
    RfSymbol
  },
  data() {
    return {
      brands: [],
      products: [],
      selectedBrand: null,
      searchQuery: '',
      loading: false,
      showCart: false,
      cartItems: []
    }
  },
  computed: {
    cartTotal() {
      return this.cartItems.reduce((total, item) => total + parseFloat(item.price), 0)
    }
  },
  watch: {
    selectedBrand() {
      this.loadProducts()
    },
    searchQuery() {
      this.loadProducts()
    }
  },
  mounted() {
    this.loadBrands()
    this.loadProducts()
  },
  methods: {
    async loadBrands() {
      try {
        const response = await axios.get('/api/brands')
        this.brands = response.data
      } catch (error) {
        console.error('Error loading brands:', error)
      }
    },
    async loadProducts() {
      this.loading = true
      try {
        const params = {}
        
        if (this.selectedBrand) {
          params.brand = this.selectedBrand
        }
        
        if (this.searchQuery) {
          params.search = this.searchQuery
        }

        const response = await axios.get('/api/products', { params })
        this.products = response.data.data
      } catch (error) {
        console.error('Error loading products:', error)
      } finally {
        this.loading = false
      }
    },
    productImage(product) {
      // Use image_urls if available (from API), otherwise fall back to images
      const images = product.image_urls || product.images
      if (images && images.length > 0) {
        return images[0]
      }
      // Return a simple placeholder data URL
      return 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjMwMCIgdmlld0JveD0iMCAwIDQwMCAzMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSI0MDAiIGhlaWdodD0iMzAwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0xNzUgMTI1SDIyNVYxNzVIMTc1VjEyNVoiIGZpbGw9IiNEMUQ1REIiLz4KPHN2ZyB4PSIxODAiIHk9IjEzMCIgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiB2aWV3Qm94PSIwIDAgNDAgNDAiIGZpbGw9Im5vbmUiPgo8cGF0aCBkPSJNMjAgMTBDMjUuNTIyOCAxMCAzMCAxNC40NzcyIDMwIDIwQzMwIDI1LjUyMjggMjUuNTIyOCAzMCAyMCAzMEMxNC40NzcyIDMwIDEwIDI1LjUyMjggMTAgMjBDMTAgMTQuNDc3MiAxNC40NzcyIDEwIDIwIDEwWiIgZmlsbD0iIzlDQTNBRiIvPgo8cGF0aCBkPSJNMjAgMTVMMjIuNSAyMEwyMCAyNUwxNy41IDIwTDIwIDE1WiIgZmlsbD0id2hpdGUiLz4KPC9zdmc+Cjx0ZXh0IHg9IjIwMCIgeT0iMjAwIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBmaWxsPSIjNkI3MjgwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiPk5vIEltYWdlPC90ZXh0Pgo8L3N2Zz4K'
    },
    formatPrice(price) {
      return parseFloat(price).toFixed(2)
    },
    addToCart(product) {
      const existingItem = this.cartItems.find(item => item.id === product.id)
      if (!existingItem) {
        this.cartItems.push({ ...product })
      }
    },
    removeFromCart(product) {
      const index = this.cartItems.findIndex(item => item.id === product.id)
      if (index > -1) {
        this.cartItems.splice(index, 1)
      }
    },
    viewProduct(product) {
      console.log('Viewing product:', product.name)
      // Could open a modal or navigate to product detail page
    }
  }
}
</script>
