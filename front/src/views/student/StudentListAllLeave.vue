<template>
  <div class="studentListAllLeave">
    <list-all-leave :student_leaves="student_leaves"></list-all-leave>
  </div>
</template>

<script>
import axios from "axios";
import AllLeave from "@/components/student/ListAllLeave.vue";
export default {
  components: {
    "list-all-leave": AllLeave,
  },
  data(){
    return {
      student_leaves:[],
      URL_API:"http://127.0.0.1:8000/api/studentleaveRequest",
    }
  },
  methods:{
    getData(){
      axios.get(this.URL_API).then((result) => {this.student_leaves=result.data})
    },
  },

   mounted() {
    this.getData()
   }
  
};
</script>

<style>
</style>