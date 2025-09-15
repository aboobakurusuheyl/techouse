<template>
  <div>
    <!-- Search and Filters -->
    <div class="bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
          <!-- Search -->
          <div class="flex-1 max-w-md">
            <div class="relative">
              <input
                v-model="searchQuery"
                @input="loadProducts"
                type="text"
                placeholder="Search products..."
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
              />
              <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
              </div>
            </div>
          </div>

          <!-- Brand Filter -->
          <div class="flex gap-2 flex-wrap">
            <button 
              @click="selectedBrand = null; loadProducts()"
              :class="[
                'px-3 py-2 text-sm font-medium rounded-md transition-colors',
                selectedBrand === null 
                  ? 'bg-indigo-600 text-white' 
                  : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
              ]"
            >
              All Brands
            </button>
            <button 
              v-for="brand in brands" 
              :key="brand.id"
              @click="selectedBrand = brand.slug; loadProducts()"
              :class="[
                'px-3 py-2 text-sm font-medium rounded-md transition-colors',
                selectedBrand === brand.slug 
                  ? 'bg-indigo-600 text-white' 
                  : 'bg-gray-100 text-gray-700 hover:bg-gray-200'
              ]"
            >
              {{ brand.name }}
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Products Grid -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      <div v-if="loading" class="text-center py-12">
        <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-indigo-600"></div>
        <p class="mt-2 text-gray-600">Loading products...</p>
      </div>

      <div v-else-if="products.length === 0" class="text-center py-12">
        <div class="text-gray-400 mb-4">
          <svg class="mx-auto h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
          </svg>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">No products found</h3>
        <p class="text-gray-600 text-lg">No products found.</p>
      </div>

      <div v-else class="grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
        <div v-for="product in products" :key="product.id" class="group relative">
          <button @click="$emit('view-product', product)" class="w-full">
            <img 
              :src="productImage(product)" 
              :alt="product.name" 
              class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80" 
            />
          </button>
          <div class="mt-4 flex justify-between">
            <div>
              <h3 class="text-sm text-gray-700">
                <button @click="$emit('view-product', product)" class="hover:text-gray-900 text-left">
                  {{ product.name }}
                </button>
              </h3>
              <p class="mt-1 text-sm text-gray-500">{{ product.brand.name }}</p>
            </div>
            <div class="text-right">
              <p class="text-sm font-medium text-gray-900 flex items-center justify-end">
                <RfSymbol class="w-4 h-4 mr-1" />
                {{ formatPrice(product.price) }}
              </p>
              <button 
                @click.stop="$emit('add-to-cart', product)"
                class="mt-2 bg-gray-900 text-white text-xs px-3 py-1 rounded-md hover:bg-gray-800 transition-colors"
              >
                Add to cart
              </button>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import RfSymbol from './rf.vue'

const emit = defineEmits(['view-product', 'add-to-cart'])

const brands = ref([])
const products = ref([])
const selectedBrand = ref(null)
const searchQuery = ref('')
const loading = ref(false)

const productImage = (product) => {
  const images = product?.image_urls || product?.images
  if (images && images.length > 0) {
    return images[0]
  }
  return 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjMwMCIgdmlld0JveD0iMCAwIDQwMCAzMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSI0MDAiIGhlaWdodD0iMzAwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0xNzUgMTI1SDIyNVYxNzVIMTc1VjEyNVoiIGZpbGw9IiNEMUQ1REIiLz4KPHN2ZyB4PSIxODAiIHk9IjEzMCIgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiB2aWV3Qm94PSIwIDAgNDAgNDAiIGZpbGw9Im5vbmUiPgo8cGF0aCBkPSJNMjAgMTBDMjUuNTIyOCAxMCAzMCAxNC40NzcyIDMwIDIwQzMwIDI1LjUyMjggMjUuNTIyOCAzMCAyMCAzMEMxNC40NzcyIDMwIDEwIDI1LjUyMjggMTAgMjBDMTAgMTQuNDc3MiAxNC40NzcyIDEwIDIwIDEwWiIgZmlsbD0iIzlDQTNBRiIvPgo8cGF0aCBkPSJNMjAgMTVMMjIuNSAyMEwyMCAyNUwxNy41IDIwTDIwIDE1WiIgZmlsbD0id2hpdGUiLz4KPC9zdmc+Cjx0ZXh0IHg9IjIwMCIgeT0iMjAwIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBmaWxsPSIjNkI3MjgwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiPk5vIEltYWdlPC90ZXh0Pgo8L3N2Zz4K'
}

const formatPrice = (price) => {
  return parseFloat(price).toFixed(2)
}

const loadBrands = async () => {
  try {
    const response = await axios.get('/api/brands')
    brands.value = response.data
  } catch (error) {
    console.error('Error loading brands:', error)
  }
}

const loadProducts = async () => {
  loading.value = true
  try {
    const params = {}
    
    if (selectedBrand.value) {
      params.brand = selectedBrand.value
    }
    
    if (searchQuery.value) {
      params.search = searchQuery.value
    }

    const response = await axios.get('/api/products', { params })
    products.value = response.data.data
  } catch (error) {
    console.error('Error loading products:', error)
  } finally {
    loading.value = false
  }
}

onMounted(() => {
  loadBrands()
  loadProducts()
})
</script>
