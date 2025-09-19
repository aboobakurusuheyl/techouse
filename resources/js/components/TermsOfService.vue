<template>
  <div class="flex-1 bg-white">
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
          <h1 class="text-3xl font-bold text-gray-900 mb-8">Terms of Service</h1>
          
          <div class="prose prose-lg max-w-none">
            <p class="text-gray-600 mb-6">Last updated: {{ currentDate }}</p>
            
            <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">Acceptance of Terms</h2>
            <p class="text-gray-700 mb-4">
              By accessing and using this website, you accept and agree to be bound by the terms 
              and provision of this agreement.
            </p>
            
            <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">Use License</h2>
            <p class="text-gray-700 mb-4">
              Permission is granted to temporarily download one copy of the materials on TEC HOUSE's 
              website for personal, non-commercial transitory viewing only.
            </p>
            
            <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">Product Information</h2>
            <p class="text-gray-700 mb-4">
              We strive to provide accurate product information, but we do not warrant that product 
              descriptions or other content is accurate, complete, reliable, or error-free.
            </p>
            
            <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">Pricing and Payment</h2>
            <p class="text-gray-700 mb-4">
              All prices are subject to change without notice. Payment terms are as specified at 
              the time of purchase.
            </p>
            
            <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">Returns and Refunds</h2>
            <p class="text-gray-700 mb-4">
              Returns and refunds are subject to our return policy. Please contact us for specific 
              return instructions.
            </p>
            
            <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">Limitation of Liability</h2>
            <p class="text-gray-700 mb-4">
              In no event shall TEC HOUSE or its suppliers be liable for any damages arising out 
              of the use or inability to use the materials on this website.
            </p>
            
            <h2 class="text-2xl font-semibold text-gray-900 mt-8 mb-4">Contact Information</h2>
            <p class="text-gray-700 mb-4">
              If you have any questions about these Terms of Service, please contact us at:
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
