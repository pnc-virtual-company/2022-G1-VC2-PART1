<template>
  <div class="studentsList">
    <student-list></student-list>
  </div>
</template>

<script>
import StudentList from "../../components/teacher/StudentList.vue"
export default {
  components: {
    "student-list":StudentList
  }

}
</script>

<style>

</style>