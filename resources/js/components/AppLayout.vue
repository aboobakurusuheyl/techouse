<template>
  <div class="min-h-screen bg-gray-50">
          <!-- Header -->
          <nav class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
              <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                  <img :src="siteSettings.logo_url || '/images/logo.webp'" :alt="siteSettings.site_name || 'TEC HOUSE'" class="h-10 w-10 mr-3" />
                  <h1 class="text-xl sm:text-2xl font-bold text-gray-900">{{ siteSettings.site_name || 'TEC HOUSE' }}</h1>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-6">
                  <button 
                    v-for="navItem in headerNavigation" 
                    :key="navItem.id"
                    @click="handleNavigation(navItem)"
                    :class="[
                      'px-3 py-2 text-sm font-medium transition-colors flex items-center',
                      isActiveNavItem(navItem) 
                        ? 'text-gray-900 border-b-2 border-gray-900' 
                        : 'text-gray-500 hover:text-gray-700'
                    ]"
                  >
                    <svg v-if="navItem.icon" class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="getIconPath(navItem.icon)" />
                    </svg>
                    {{ navItem.name }}
                  </button>
                </div>
                
                <!-- Desktop Cart -->
                <div class="hidden md:flex items-center">
                  <button 
                    @click="showCart = !showCart"
                    class="relative p-2 text-gray-600 hover:text-gray-900 transition-colors group"
                    :title="`Cart (${cartItems.length} items)`"
                  >
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM20.25 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>
                    <span v-if="cartItems.length > 0" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-medium animate-pulse">
                      {{ cartItems.length }}
                    </span>
                  </button>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center space-x-2 mobile-menu-container">
                  <!-- Mobile Cart -->
                  <button 
                    @click="showCart = !showCart"
                    class="relative p-2 text-gray-600 hover:text-gray-900 transition-colors"
                    :title="`Cart (${cartItems.length} items)`"
                  >
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM20.25 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                    </svg>
                    <span v-if="cartItems.length > 0" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-medium animate-pulse">
                      {{ cartItems.length }}
                    </span>
                  </button>
                  
                  <!-- Hamburger Menu Button -->
                  <button 
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    class="p-2 text-gray-600 hover:text-gray-900 transition-colors"
                    :class="{ 'text-gray-900': mobileMenuOpen }"
                  >
                    <svg v-if="!mobileMenuOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg v-else class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                  </button>
                </div>
              </div>

              <!-- Mobile Navigation Menu -->
              <div v-show="mobileMenuOpen" class="md:hidden mobile-menu-container">
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-gray-50 border-t">
                  <button 
                    v-for="navItem in headerNavigation" 
                    :key="navItem.id"
                    @click="handleNavigation(navItem); mobileMenuOpen = false"
                    :class="[
                      'block w-full text-left px-3 py-2 text-base font-medium transition-colors flex items-center',
                      isActiveNavItem(navItem) 
                        ? 'text-gray-900 bg-gray-200' 
                        : 'text-gray-500 hover:text-gray-700 hover:bg-gray-100'
                    ]"
                  >
                    <svg v-if="navItem.icon" class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="getIconPath(navItem.icon)" />
                    </svg>
                    {{ navItem.name }}
                  </button>
                </div>
              </div>
            </div>
          </nav>

    <!-- Main Content -->
    <main class="flex-1">
      <slot></slot>
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
                <img :src="productImage(item)" :alt="item.name" class="h-16 w-16 object-cover rounded" />
                <div class="flex-1">
                  <h3 class="text-sm font-medium text-gray-900">{{ item.name }}</h3>
                  <p class="text-sm text-gray-500">{{ item.brand?.name }}</p>
                  <p class="text-sm font-medium text-gray-900">₦{{ formatPrice(item.price) }}</p>
                </div>
                <button @click="$emit('remove-from-cart', item)" class="text-red-500 hover:text-red-700">
                  <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
              </div>
            </div>
          </div>
          
          <div v-if="cartItems.length > 0" class="border-t p-4">
            <div class="flex justify-between text-lg font-semibold mb-4">
              <span>Total:</span>
              <span>₦{{ formatPrice(cartTotal) }}</span>
            </div>
            <button class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700 transition-colors">
              Checkout
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-50">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <!-- Company Info -->
          <div>
            <div class="flex items-center mb-4">
              <img :src="siteSettings.logo_url || '/images/logo.webp'" :alt="siteSettings.site_name || 'TEC HOUSE'" class="h-8 w-8 mr-2" />
              <h3 class="text-xl font-bold text-gray-900">{{ siteSettings.site_name || 'TEC HOUSE' }}</h3>
            </div>
            <p class="text-gray-600 text-sm mb-4">
              {{ siteSettings.footer_description || siteSettings.site_tagline || 'Your trusted partner for quality electronics and technology products.' }}
            </p>
            <div class="text-xs text-gray-500">
              {{ siteSettings.footer_copyright || '© 2025 TecHouse. All rights reserved.' }}
            </div>
          </div>

          <!-- Contact Info -->
          <div>
            <h4 class="text-sm font-semibold text-gray-900 mb-4">Contact Us</h4>
            <div class="space-y-2 text-sm text-gray-600">
              <p v-if="siteSettings.contact_phone">📞 <a :href="`tel:${siteSettings.contact_phone}`" class="hover:text-gray-900">{{ siteSettings.contact_phone }}</a></p>
              <p v-if="siteSettings.contact_email">📧 <a :href="`mailto:${siteSettings.contact_email}`" class="hover:text-gray-900">{{ siteSettings.contact_email }}</a></p>
              <p v-if="siteSettings.contact_address">📍 {{ siteSettings.contact_address }}</p>
            </div>
          </div>

          <!-- Quick Links -->
          <div>
            <h4 class="text-sm font-semibold text-gray-900 mb-4">Quick Links</h4>
            <div class="space-y-2 text-sm text-gray-600">
              <p v-for="navItem in footerNavigation" :key="navItem.id">
                <button 
                  v-if="navItem.type === 'link' && navItem.url === '/products'"
                  @click="$emit('navigate', 'home')" 
                  class="hover:text-gray-900"
                >
                  {{ navItem.name }}
                </button>
                <a 
                  v-else-if="navItem.type === 'link'"
                  :href="navItem.url" 
                  class="hover:text-gray-900"
                >
                  {{ navItem.name }}
                </a>
                <a 
                  v-else-if="navItem.type === 'external'"
                  :href="navItem.url" 
                  target="_blank"
                  rel="noopener noreferrer"
                  class="hover:text-gray-900"
                >
                  {{ navItem.name }}
                </a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import axios from 'axios'

const props = defineProps({
  currentView: {
    type: String,
    default: 'home'
  },
  brands: {
    type: Array,
    default: () => []
  },
  selectedBrand: {
    type: String,
    default: null
  },
  cartItems: {
    type: Array,
    default: () => []
  }
})

const emit = defineEmits(['navigate', 'filter-brand', 'add-to-cart', 'remove-from-cart'])

const showCart = ref(false)
const mobileMenuOpen = ref(false)
const headerNavigation = ref([])
const footerNavigation = ref([])
const siteSettings = ref({})

// Close mobile menu when clicking outside
const closeMobileMenu = (event) => {
  if (mobileMenuOpen.value && !event.target.closest('.mobile-menu-container')) {
    mobileMenuOpen.value = false
  }
}

// Add event listener for clicking outside
onMounted(() => {
  document.addEventListener('click', closeMobileMenu)
})

onUnmounted(() => {
  document.removeEventListener('click', closeMobileMenu)
})

// Expose showCart to parent component
defineExpose({
  showCart
})

const cartTotal = computed(() => {
  return props.cartItems.reduce((total, item) => total + parseFloat(item.price), 0)
})

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

const loadNavigation = async () => {
  try {
    const [headerResponse, footerResponse] = await Promise.all([
      axios.get('/api/navigation/header'),
      axios.get('/api/navigation/footer')
    ])
    
    headerNavigation.value = headerResponse.data
    footerNavigation.value = footerResponse.data
  } catch (error) {
    console.error('Error loading navigation:', error)
  }
}

const loadSiteSettings = async () => {
  try {
    const response = await axios.get('/api/site-settings')
    siteSettings.value = response.data
  } catch (error) {
    console.error('Error loading site settings:', error)
  }
}

const handleNavigation = (navItem) => {
  if (navItem.type === 'link') {
    if (navItem.url === '/products' || navItem.url === '/') {
      emit('navigate', 'home')
    } else {
      // For other internal links, you might want to handle them differently
      window.location.href = navItem.url
    }
  } else if (navItem.type === 'external') {
    window.open(navItem.url, '_blank', 'noopener,noreferrer')
  }
}

const isActiveNavItem = (navItem) => {
  if (navItem.url === '/products' || navItem.url === '/') {
    return props.currentView === 'home'
  }
  return false
}

const getIconPath = (iconName) => {
  const iconPaths = {
    'home': 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6',
    'shopping-bag': 'M16 11V7a4 4 0 00-8 0v4M5 9h14l-1 7a2 2 0 01-2 2H8a2 2 0 01-2-2L5 9z',
    'information-circle': 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
    'phone': 'M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z',
    'user': 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
    'cog': 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'
  }
  return iconPaths[iconName] || iconPaths['home']
}

onMounted(() => {
  loadNavigation()
  loadSiteSettings()
})
</script>
