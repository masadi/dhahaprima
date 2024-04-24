<script setup>
import Footer from '@/views/front-pages/front-page-footer.vue'
import Navbar from '@/views/front-pages/front-page-navbar.vue'
import ContactUs from '@/views/front-pages/landing-page/contact-us.vue'
definePage({ meta: { 
  layout: 'blank',
  public: true
} })
const activeSectionId = ref('contact-us')
</script>

<template>
  <div class="landing-page-wrapper">
    <Navbar :active-id="activeSectionId" />
    <ContactUs ref="refContact" />
    <Footer />
  </div>
</template>
