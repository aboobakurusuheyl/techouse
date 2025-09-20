<template>
  <div class="flex-1 bg-white">
    <!-- Loading State -->
    <div v-if="loading" class="flex items-center justify-center min-h-96">
      <div class="text-center">
        <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div>
        <p class="mt-2 text-gray-600">Loading product...</p>
      </div>
    </div>

    <!-- Product Content -->
    <div v-else-if="product && product.id" class="pt-6">
      <!-- Breadcrumb -->
      <nav aria-label="Breadcrumb">
        <ol role="list" class="mx-auto flex max-w-2xl items-center space-x-2 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
          <li>
            <div class="flex items-center">
              <button @click="$emit('back-to-products')" class="mr-2 text-sm font-medium text-gray-900 hover:text-gray-700 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Products
              </button>
            </div>
          </li>
        </ol>
      </nav>

      <!-- Image gallery -->
      <div class="mx-auto mt-6 max-w-2xl sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:gap-8 lg:px-8">
        <!-- Mobile image -->
        <div class="lg:hidden">
          <img 
            :src="productImage(product)" 
            :alt="product && product.name ? product.name : 'Product'" 
            class="w-full h-96 object-contain bg-gray-100 rounded-lg"
          />
        </div>
        <!-- Main image -->
        <img 
          :src="productImage(product)" 
          :alt="product && product.name ? product.name : 'Product'" 
          class="row-span-2 aspect-[3/4] size-full rounded-lg object-contain bg-gray-100 max-lg:hidden" 
        />
        
        <!-- Additional images if available -->
        <template v-if="productImages.length > 1">
          <img 
            v-for="(image, index) in productImages.slice(1, 4)" 
            :key="index"
            :src="image" 
            :alt="(product && product.name ? product.name : 'Product') + ' view ' + (index + 1)" 
            :class="[
              index === 0 ? 'col-start-2 aspect-[3/2] size-full rounded-lg object-contain bg-gray-100 max-lg:hidden' : '',
              index === 1 ? 'col-start-2 row-start-2 aspect-[3/2] size-full rounded-lg object-contain bg-gray-100 max-lg:hidden' : '',
              index === 2 ? 'row-span-2 aspect-[4/5] size-full object-contain bg-gray-100 sm:rounded-lg lg:aspect-[3/4]' : ''
            ]"
          />
        </template>
        
        <!-- Fallback for single image -->
        <img 
          v-if="productImages.length === 1"
          :src="productImage(product)" 
          :alt="product && product.name ? product.name : 'Product'" 
          class="row-span-2 aspect-[3/4] size-full rounded-lg object-contain bg-gray-100"
        />
      </div>

      <!-- Product info -->
      <div class="mx-auto max-w-2xl px-4 pb-16 pt-10 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto_auto_1fr] lg:gap-x-8 lg:px-8 lg:pb-24 lg:pt-16">
        <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
          <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl" v-text="product && product.name ? product.name : 'Loading...'"></h1>
          <p class="mt-2 text-sm text-gray-500" v-text="product && product.brand && product.brand.name ? product.brand.name : ''"></p>
        </div>

        <!-- Options -->
        <div class="mt-6 lg:row-span-3 lg:mt-0">
          <h2 class="sr-only">Product information</h2>
          <div class="flex items-center">
            <p class="text-3xl tracking-tight text-gray-900 flex items-center">
              <RfSymbol class="w-8 h-8 mr-2" />
              <span v-text="product && product.price ? formatPrice(product.price) : '0.00'"></span>
            </p>
            <p v-if="product && product.sale_price" class="ml-4 text-lg text-gray-500 line-through flex items-center">
              <RfSymbol class="w-5 h-5 mr-1" />
              <span v-text="formatPrice(product.sale_price)"></span>
            </p>
          </div>

          <!-- Reviews placeholder -->
          <!-- Product Info -->
          <div class="mt-6 space-y-2">
            <div v-if="product && product.sku" class="text-sm text-gray-600">
              <span class="font-medium">SKU:</span> {{ product.sku }}
            </div>
            <div v-if="product && product.stock_quantity !== undefined" class="text-sm">
              <span class="font-medium text-gray-600">Stock:</span>
              <span :class="product.stock_quantity > 0 ? 'text-green-600' : 'text-red-600'">
                {{ product.stock_quantity > 0 ? `${product.stock_quantity} in stock` : 'Out of stock' }}
              </span>
            </div>
          </div>

          <div class="mt-6">
            <h3 class="sr-only">Reviews</h3>
            <div class="flex items-center">
              <div class="flex items-center">
                <svg v-for="rating in [0, 1, 2, 3, 4]" :key="rating" :class="[4 > rating ? 'text-gray-900' : 'text-gray-200', 'size-5 shrink-0']" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
              </div>
              <p class="sr-only">4 out of 5 stars</p>
              <span class="ml-3 text-sm font-medium text-gray-600">No reviews yet</span>
            </div>
          </div>

          <form @submit.prevent="addToCart" class="mt-10">
            <!-- Colors (if available) -->
            <div v-if="productColors.length > 0">
              <h3 class="text-sm font-medium text-gray-900">Color</h3>
              <fieldset aria-label="Choose a color" class="mt-4">
                <div class="flex items-center gap-x-3">
                  <div v-for="color in productColors" :key="color.id" class="flex rounded-full outline outline-1 -outline-offset-1 outline-black/10">
                    <input 
                      :aria-label="color.name" 
                      type="radio" 
                      name="color" 
                      :value="color.id" 
                      v-model="selectedColor"
                      :class="[color.classes, 'size-8 appearance-none rounded-full forced-color-adjust-none checked:outline checked:outline-2 checked:outline-offset-2 focus-visible:outline focus-visible:outline-[3px] focus-visible:outline-offset-[3px]']" 
                    />
                  </div>
                </div>
              </fieldset>
            </div>

            <!-- Sizes (if available) -->
            <div v-if="productSizes.length > 0" class="mt-10">
              <div class="flex items-center justify-between">
                <h3 class="text-sm font-medium text-gray-900">Size</h3>
                <a href="#" class="text-sm font-medium text-primary hover:text-primary-600">Size guide</a>
              </div>
              <fieldset aria-label="Choose a size" class="mt-4">
                <div class="grid grid-cols-4 gap-3">
                  <label v-for="size in productSizes" :key="size.id" :aria-label="size.name" class="group relative flex items-center justify-center rounded-md border border-gray-300 bg-white p-3 has-[:checked]:border-primary has-[:disabled]:border-gray-400 has-[:checked]:bg-primary has-[:disabled]:bg-gray-200 has-[:disabled]:opacity-25 has-[:focus-visible]:outline has-[:focus-visible]:outline-2 has-[:focus-visible]:outline-offset-2 has-[:focus-visible]:outline-primary">
                    <input type="radio" name="size" :value="size.id" v-model="selectedSize" :disabled="!size.inStock" class="absolute inset-0 appearance-none focus:outline focus:outline-0 disabled:cursor-not-allowed" />
                    <span class="text-sm font-medium uppercase text-gray-900 group-has-[:checked]:text-white" v-text="size.name"></span>
                  </label>
                </div>
              </fieldset>
            </div>

            <button 
              type="submit" 
              :class="[
                'mt-10 flex w-full items-center justify-center rounded-md border border-transparent px-8 py-3 text-base font-medium focus:outline-none focus:ring-2 focus:ring-offset-2',
                (product && product.stock_quantity === 0) || loading
                  ? 'bg-gray-400 text-gray-200 cursor-not-allowed'
                  : 'bg-primary text-white hover:bg-primary-600 focus:ring-primary'
              ]"
              :disabled="loading || (product && product.stock_quantity === 0)"
            >
              <span v-if="loading">Adding...</span>
              <span v-else-if="product && product.stock_quantity === 0">Out of Stock</span>
              <span v-else>Add to cart</span>
            </button>
          </form>
        </div>

        <div class="py-6 lg:py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pb-16 lg:pr-8 lg:pt-6">
          <!-- Description and details -->
          <div>
            <h3 class="sr-only">Description</h3>
            <div class="space-y-6">
              <p class="text-base text-gray-900" v-text="product && product.description ? product.description : 'No description available.'"></p>
            </div>
          </div>

          <div class="mt-10">
            <h3 class="text-sm font-medium text-gray-900">Highlights</h3>
            <div class="mt-4">
              <ul role="list" class="list-disc space-y-2 pl-4 text-sm">
                <li v-for="highlight in productHighlights" :key="highlight" class="text-gray-400">
                  <span class="text-gray-600" v-text="highlight"></span>
                </li>
              </ul>
            </div>
          </div>

          <div class="mt-10">
            <h2 class="text-sm font-medium text-gray-900">Details</h2>
            <div class="mt-4 space-y-6">
              <p class="text-sm text-gray-600" v-text="productDetails"></p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Error State -->
    <div v-else class="flex items-center justify-center min-h-96">
      <div class="text-center">
        <div class="text-gray-400 mb-4">
          <svg class="mx-auto h-12 w-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
          </svg>
        </div>
        <h3 class="text-lg font-medium text-gray-900 mb-2">Product not found</h3>
        <p class="text-gray-600 mb-4">The product you're looking for doesn't exist or has been removed.</p>
        <button @click="$emit('back-to-products')" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-primary-600">
          Back to Products
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted, watch } from 'vue'
import axios from 'axios'
import RfSymbol from './rf.vue'

const props = defineProps({
  productId: {
    type: [String, Number],
    required: true
  }
})

const emit = defineEmits(['back-to-products', 'add-to-cart'])

const product = ref({})
const loading = ref(false)
const selectedColor = ref('')
const selectedSize = ref('')

// Computed properties
const productImages = computed(() => {
  if (product.value && product.value.image_urls && product.value.image_urls.length > 0) {
    return product.value.image_urls
  }
  if (product.value && product.value.images && product.value.images.length > 0) {
    return product.value.images
  }
  return [productImage(product.value)]
})

const productColors = computed(() => {
  return [
    { id: 'white', name: 'White', classes: 'bg-white checked:outline-gray-400' },
    { id: 'gray', name: 'Gray', classes: 'bg-gray-200 checked:outline-gray-400' },
    { id: 'black', name: 'Black', classes: 'bg-gray-900 checked:outline-gray-900' },
  ]
})

const productSizes = computed(() => {
  return [
    { id: 'xs', name: 'XS', inStock: true },
    { id: 's', name: 'S', inStock: true },
    { id: 'm', name: 'M', inStock: true },
    { id: 'l', name: 'L', inStock: true },
    { id: 'xl', name: 'XL', inStock: true },
    { id: '2xl', name: '2XL', inStock: false },
  ]
})

const productHighlights = computed(() => {
  if (product.value && product.value.specifications) {
    return Object.entries(product.value.specifications).map(([key, value]) => `${key}: ${value}`)
  }
  return [
    'High quality materials',
    'Durable construction', 
    'Modern design',
    'Easy to use'
  ]
})

const productDetails = computed(() => {
  if (product.value && product.value.description) {
    return product.value.description
  }
  if (product.value && product.value.short_description) {
    return product.value.short_description
  }
  return 'This product offers excellent quality and performance. Perfect for everyday use.'
})

// Methods
const productImage = (product) => {
  const images = (product && product.image_urls) || (product && product.images)
  if (images && images.length > 0) {
    return images[0]
  }
  return 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAwIiBoZWlnaHQ9IjMwMCIgdmlld0JveD0iMCAwIDQwMCAzMDAiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSI0MDAiIGhlaWdodD0iMzAwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik0xNzUgMTI1SDIyNVYxNzVIMTc1VjEyNVoiIGZpbGw9IiNEMUQ1REIiLz4KPHN2ZyB4PSIxODAiIHk9IjEzMCIgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiB2aWV3Qm94PSIwIDAgNDAgNDAiIGZpbGw9Im5vbmUiPgo8cGF0aCBkPSJNMjAgMTBDMjUuNTIyOCAxMCAzMCAxNC40NzcyIDMwIDIwQzMwIDI1LjUyMjggMjUuNTIyOCAzMCAyMCAzMEMxNC40NzcyIDMwIDEwIDI1LjUyMjggMTAgMjBDMTAgMTQuNDc3MiAxNC40NzcyIDEwIDIwIDEwWiIgZmlsbD0iIzlDQTNBRiIvPgo8cGF0aCBkPSJNMjAgMTVMMjIuNSAyMEwyMCAyNUwxNy41IDIwTDIwIDE1WiIgZmlsbD0id2hpdGUiLz4KPC9zdmc+Cjx0ZXh0IHg9IjIwMCIgeT0iMjAwIiB0ZXh0LWFuY2hvcj0ibWlkZGxlIiBmaWxsPSIjNkI3MjgwIiBmb250LWZhbWlseT0iQXJpYWwiIGZvbnQtc2l6ZT0iMTQiPk5vIEltYWdlPC90ZXh0Pgo8L3N2Zz4K'
}

const formatPrice = (price) => {
  if (!price) return '0.00'
  return parseFloat(price).toFixed(2)
}

const addToCart = () => {
  if (!product.value || !product.value.id) return
  
  loading.value = true
  
  const cartItem = {
    ...product.value,
    selectedColor: selectedColor.value,
    selectedSize: selectedSize.value
  }
  
  // Emit to parent component
  emit('add-to-cart', cartItem)
  
  // Reset loading state
  setTimeout(() => {
    loading.value = false
  }, 500)
}

const loadProduct = async () => {
  try {
    loading.value = true
    console.log('Loading product with ID:', props.productId)
    const response = await axios.get(`/api/products/${props.productId}`)
    console.log('Product API response:', response.data)
    
    if (response.data && response.data.data) {
      product.value = response.data.data
      console.log('Product loaded successfully:', product.value)
    } else if (response.data) {
      product.value = response.data
      console.log('Product loaded (direct data):', product.value)
    } else {
      product.value = {}
      console.log('No product data found')
    }
  } catch (error) {
    console.error('Error loading product:', error)
    console.error('Error details:', error.response?.data)
    product.value = {}
  } finally {
    loading.value = false
  }
}

// Watch for productId changes
watch(() => props.productId, (newId) => {
  if (newId) {
    loadProduct()
  }
}, { immediate: true })

onMounted(() => {
  loadProduct()
})
</script>