<template>
  <div class="container">
    <table>
      <thead>
        <tr>
          <th>Start Date</th>
          <th>End Date</th>
          <th>Reason</th>
          <th>Duration</th>
          <th>Leave Type</th>
          <th>Status</th>
          <th>Request Date</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>11/4/2022</td>
          <td>13/4/2022</td>
          <td>Go to homtown</td>
          <td>2</td>
          <td>Family's even</td>
          <td class="padding">Padding</td>
          <td>13/4/2022</td>
        </tr>
        <tr>
          <td>11/4/2022</td>
          <td>13/4/2022</td>
          <td>Go to homtown</td>
          <td>2</td>
          <td>Family's even</td>
          <td class="approved">Approved</td>
          <td>13/4/2022</td>
        </tr>
        <tr>
          <td>11/4/2022</td>
          <td>13/4/2022</td>
          <td>Go to homtown</td>
          <td>2</td>
          <td>Family's even</td>
          <td class="canceled">Canceled</td>
          <td>13/4/2022</td>
        </tr>

        <tr>
          <td>11/4/2022</td>
          <td>13/4/2022</td>
          <td>Go to homtown</td>
          <td>2</td>
          <td>Family's even</td>
          <td class="rejected">Rejected</td>
          <td>13/4/2022</td>
        </tr>
        <tr>
          <td>11/4/2022</td>
          <td>13/4/2022</td>
          <td>Go to homtown</td>
          <td>2</td>
          <td>Family's even</td>
          <td class="canceled">Canceled</td>
          <td>13/4/2022</td>
        </tr>
        <tr>
          <td>11/4/2022</td>
          <td>13/4/2022</td>
          <td>Go to homtown</td>
          <td>2</td>
          <td>Family's even</td>
          <td class="padding">Padding</td>
          <td>13/4/2022</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {};
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