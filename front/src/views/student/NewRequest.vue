<template>
<div class="newRequest">
  <request-form></request-form>
</div>
</template>
<script>
import NewRequestForm from "@/components/student/NewRequestForm.vue"
export default {
  components:{
    'request-form': NewRequestForm,
  }
}
</script>

<style scoped>
  .newRequest{
    width: 30rem;
    margin: auto;
  }
</style>>
