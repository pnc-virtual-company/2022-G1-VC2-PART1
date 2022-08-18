<template>
<form>
  <h1>Student Leave</h1>
  <div class="checkLeave">
    <div class="student_infor">
      <img src="../../assets/one.jpg" alt="" />
      <h2 class="name_stu">Samoul Vann</h2>
    </div>
    <div class="reson_data">
      <div class="status">Padding</div>
      <div class="dete">11/22/2022</div>
    </div>
  </div>

  <div class="checkLeave">
    <div class="student_infor">
      <img src="../../assets/koko.jpg" alt="" />
      <h2 class="name_stu">VanSao</h2>
    </div>
    <div class="reson_data">
      <div class="status">Padding</div>
      <div class="dete">11/22/2022</div>
    </div>
  </div>

  <div class="checkLeave">
    <div class="student_infor">
      <img src="../../assets/koko.jpg" alt="" />
      <h2 class="name_stu">VanSao</h2>
    </div>
    <div class="reson_data">
      <div class="status">Padding</div>
      <div class="dete">11/22/2022</div>
    </div>
  </div>
</form>
</template>

<script>
export default {};
</script>

<style scoped>
.checkLeave {
  display: flex;
  justify-content: space-between;
  margin: auto;
  background: #e1e7ea;
  width: 70%;
  height: 110px;
  border-radius: 10px;
  border-left: 2px solid orange;
  padding: 5px;
  margin-bottom: 10px;
}
.student_infor {
  display: flex;
}
.checkLeave .student_infor img {
  height: 90px;
  height: 90px;
  border-radius: 50%;
  margin-left: 10px;
  object-fit: cover;
  border: 2px solid orange;
  display: flex;
  align-items: center;
  transition: 0.5s;
}
.checkLeave .student_infor img:hover {
  transform: scale(1.1);
}
.checkLeave .student_infor h2 {
  display: flex;
  align-items: center;
  margin: 10px;
}
.status {
  color: orange;
}
.name_stu {
  color: rgb(38, 140, 190);
}
.checkLeave .reson_data {
  display: flex;
  align-items: flex-end;
}
h1 {
  display: flex;
  justify-content: center;
  padding: 10px;
  color: rgb(38, 140, 190);
}
form{
 
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.25);
  width: 60%;
  margin: auto;
}
</style>
