<template>
  <div>
      <Header />
        <slot />
      <Footer />
  </div>
</template>

<script setup lang="ts">
useHead({
  title: 'HONDA INC.',
})
</script>
