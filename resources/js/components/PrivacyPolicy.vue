<template>
  <div class="bg-white">
    <div class="pt-6">
      <!-- Breadcrumb -->
      <nav aria-label="Breadcrumb">
        <ol role="list" class="mx-auto flex max-w-2xl items-center space-x-2 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
          <li>
            <div class="flex items-center">
              <button @click="$emit('back-to-home')" class="mr-2 text-sm font-medium text-gray-900 hover:text-gray-700 flex items-center">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Home
              </button>
            </div>
          </li>
        </ol>
      </nav>

      <!-- Main Content -->
      <main class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="bg-white rounded-lg shadow-sm p-8">
          <h1 class="text-3xl font-bold text-gray-900 mb-8">Privacy Policy</h1>
          
          <div class="prose prose-lg max-w-none">
            <p class="text-gray-600 mb-6">Last updated: {{ currentDate }}</p>
            
            <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">Information We Collect</h2>
            <p class="text-gray-700 mb-4">
              We collect information you provide directly to us, such as when you create an account, 
              make a purchase, or contact us for support.
            </p>
            
            <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">How We Use Your Information</h2>
            <p class="text-gray-700 mb-4">
              We use the information we collect to provide, maintain, and improve our services, 
              process transactions, and communicate with you.
            </p>
            
            <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">Information Sharing</h2>
            <p class="text-gray-700 mb-4">
              We do not sell, trade, or otherwise transfer your personal information to third parties 
              without your consent, except as described in this policy.
            </p>
            
            <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">Data Security</h2>
            <p class="text-gray-700 mb-4">
              We implement appropriate security measures to protect your personal information against 
              unauthorized access, alteration, disclosure, or destruction.
            </p>
            
            <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">Contact Us</h2>
            <p class="text-gray-700 mb-4">
              If you have any questions about this Privacy Policy, please contact us at:
            </p>
            <ul class="list-disc pl-6 text-gray-700">
              <li>Email: info@techouse.com</li>
              <li>Phone: +960 777-1811</li>
              <li>Address: Malé, Maldives</li>
            </ul>
          </div>
        </div>
      </main>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const emit = defineEmits(['back-to-home'])

const currentDate = computed(() => {
  return new Date().toLocaleDateString('en-US', {
    year: 'numeric',
    month: 'long',
    day: 'numeric'
  })
})
</script>
