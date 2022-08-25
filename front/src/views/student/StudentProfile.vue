<template>
  <profile-view :profile="profile"></profile-view>
</template>

<script>
import StudentProfile from "@/components/student/StudentProfileView.vue";
import http from "../../axios-http";

export default {
  components: { "profile-view": StudentProfile },

  data() {
    return {
      profile: {},
    };
  },
  methods: {
    getStudentProfile() {
      http.get("student/9").then((result) => {
        this.profile = result.data[0];
      });
    },

  },

  mounted() {
    this.getStudentProfile();
  },
};
</script>
