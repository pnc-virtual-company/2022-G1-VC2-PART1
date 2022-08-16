<template>
  <div class="container">
    <table>
      <thead>
        <tr>
          <th>Start Date </th>
          <th>End Date</th>
          <th>Reason</th>
          <th>Duration</th>
          <th>Leave Type</th>
          <th>Status</th>
          <th>Request Date</th>
        </tr>
      </thead>

      <tbody  v-for="listOfLeave of ListAllLeave" :key="listOfLeave" >
        <tr>
          <td>{{listOfLeave.Start_Date}}</td>
          <td>{{listOfLeave.End_Date}}</td>
          <td>{{listOfLeave.Reason}}</td>
          <td>{{listOfLeave.Duration}}</td>
          <td>{{listOfLeave.Leave_Type}}</td>
          <td>{{listOfLeave.Status}}</td>
          <td>{{listOfLeave.Request_Date}}</td>
        </tr>
        
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  props:{
    ListAllLeave:[],
  }
};
</script>

<style scoped>
.container {
  width: 85%;
  margin: auto;
}
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 2vh;
}
tr,
th,
td {
  border: 2px solid gray;
  padding: 10px;
}

thead tr th {
  border: 2px solid gray;
  background-color: #144e5a;
  color: #fff;
}
/* tbody tr:hover{
    background-color: skyblue;
} */
.padding {
  color: #ffba07;
}
.approved {
  color: #3e9e10;
}
.rejected {
  color: #fe0000;
}
.canceled {
  color: #1e43c7;
}
</style>