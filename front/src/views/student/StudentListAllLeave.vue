<template>
  <div class="studentListAllLeave">
    <list-all-leave :student_leaves="student_leaves"></list-all-leave>
  </div>
</template>

<script>
import http from '../../axios-http'
import AllLeave from "@/components/student/ListAllLeave.vue";
export default {
  components: {
    "list-all-leave": AllLeave,
  },
  data(){
    return {
      student_leaves:[],
    }
  },
  methods:{
    getData(){
      http.get("studentleaveRequest").then((result) => {this.student_leaves=result.data})
    },
  },

   mounted() {
    this.getData()
   }
  
};
</script>

<style>
</style>