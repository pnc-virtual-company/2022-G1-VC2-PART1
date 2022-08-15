<template>
<div class="newRequest">
  <request-form></request-form>
</div>
</template>

<script>
import NewRequestForm from "@/components/NewRequestForm.vue"
export default {
  components:{
    'request-form': NewRequestForm,
  }
}
</script>

<style>

</style>