<template>
  <div class="studentListAllLeave">
    <list-all-leave :ListAllLeave="ListAllLeave"></list-all-leave>
  </div>
</template>

<script>
import AllLeave from "@/components/student/ListAllLeave.vue";
export default {
  components: {
    "list-all-leave": AllLeave,
  },
  data() {
    return {
      ListAllLeave: [
        {
          Start_Date: "11/4/2022",
          End_Date: "13/4/2022",
          Reason: "Go to homtown",
          Duration: 2,
          Leave_Type: "	Family's even",
          Status: "Padding",
          Request_Date: "13/4/2022",
        },
        {
          Start_Date: "11/4/2022",
          End_Date: "13/4/2022",
          Reason: "Go to homtown",
          Duration: 2,
          Leave_Type: "	Family's even",
          Status: "Approved",
          Request_Date: "13/4/2022",
        },
        {
          Start_Date: "11/4/2022",
          End_Date: "13/4/2022",
          Reason: "Go to homtown",
          Duration: 2,
          Leave_Type: "	Family's even",
          Status: "Canceled",
          Request_Date: "13/4/2022",
        },
        {
          Start_Date: "11/4/2022",
          End_Date: "13/4/2022",
          Reason: "Go to homtown",
          Duration: 2,
          Leave_Type: "	Family's even",
          Status: "Rejected",
          Request_Date: "13/4/2022",
        },
        {
          Start_Date: "11/4/2022",
          End_Date: "13/4/2022",
          Reason: "Go to homtown",
          Duration: 2,
          Leave_Type: "	Family's even",
          Status: "Padding",
          Request_Date: "13/4/2022",
        },
        {
          Start_Date: "11/4/2022",
          End_Date: "13/4/2022",
          Reason: "Go to homtown",
          Duration: 2,
          Leave_Type: "	Family's even",
          Status: "Rejected",
          Request_Date: "13/4/2022",
        },
        {
          Start_Date: "11/4/2022",
          End_Date: "13/4/2022",
          Reason: "Go to homtown",
          Duration: 2,
          Leave_Type: "	Family's even",
          Status: "Canceled",
          Request_Date: "13/4/2022",
        },
      ],
    };
  },
};
</script>

<style>
</style>